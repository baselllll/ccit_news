<?php

namespace App\Services;

use App\Repositories\GeneralSettingRepository;
use Illuminate\View\View;

class RenderComposer
{
    public function __construct(GeneralSettingRepository $generalSettingRepo)
    {
        $this->generalSettingRepo = $generalSettingRepo;
    }
    public function compose(View $view)
    {
        $view->with([
            'settings' => $this->generalSettingRepo->fetchSettings(),
        ]);
    }
}
