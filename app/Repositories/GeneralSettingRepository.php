<?php

namespace App\Repositories;

use App\Models\GeneralSetting;
use App\Services\FileService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneralSettingRepository
{
    public function __construct(GeneralSetting $generalSetting)
    {
        $this->generalSetting = $generalSetting;
    }

    public function fetchSettings()
    {
        return $this->generalSetting->with('media')->first();
    }

    public function update(array $data)
    {
        if (isset($data['white_logo']))
            $data['white_logo'] = $this->addImage($data['white_logo']);

        if (isset($data['black_logo']))
            $data['black_logo'] = $this->addImage($data['black_logo']);
        DB::beginTransaction();
        try {
            $settings = $this->fetchSettings();
            $settings->update($data);
            if (!is_null($file = Arr::pull($data, 'image', null))) {
                $settings->clearMediaCollection('settings_images');
                $settings->addMedia($file)
                    ->preservingOriginal()
                    ->toMediaCollection('settings_images');
            }
            DB::commit();
        }catch (\Exception $exception)
        {
            DB::rollback();
            Log::error($exception);
            throw new \Exception($exception->getMessage());
        }

        return $settings;
    }

    protected function addImage($image) :String
    {
        return FileService::saveFile($image, 'logos');
    }
}
