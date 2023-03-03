<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\DeleteContactRequest;
use App\Repositories\GeneralSettingRepository;
use Illuminate\Http\Request;


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

    public function update(Request $request)
    {
        $settings = $this->generalSettingRepo->update($request->all());
        return redirect()->back()->with('success', __('apiMessages.support.updated'));
    }
}
