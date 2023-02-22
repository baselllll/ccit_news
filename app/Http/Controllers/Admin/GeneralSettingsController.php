<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\DeleteContactRequest;
use App\Repositories\GeneralSettingRepository;


class GeneralSettingsController extends Controller
{
    public function __construct(GeneralSettingRepository $generalSettingRepo)
    {
        $this->generalSettingRepo = $generalSettingRepo;
    }

    public function index()
    {
        $settings = $this->generalSettingRepo->fetchSettings();
        return view('admin.pages.settings.index',compact('settings'));
    }

    public function update(DeleteContactRequest $request)
    {
        $settings = $this->generalSettingRepo->update($request->all());
        $urls = [
            'black_logo_url' => asset('storage/'.$settings?->black_logo),
            'white_logo_url' => asset('storage/'.$settings?->white_logo),
        ];
        return response([
            'settings' => $settings,
            'urls'=> $urls,
            'message' => __('apiMessages.settings.updated'),
        ],200);
    }
}
