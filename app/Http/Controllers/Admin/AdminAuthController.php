<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->authService = new AuthService('admin');
    }
    public function getLogin()
    {
        return view('admin.pages.login');
    }

    public function authenticateAdmin(Request $request)
    {
        if($this->authService->authenticate($request->only('email', 'password')))
        {
            auth()->guard('admin')->user()->update(['last_login'=>date('Y-m-d H:i:s')]);
            return redirect(RouteServiceProvider::ADMIN);
        }
        return redirect()->back()->with('error', trans('auth.failed'));
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect(RouteServiceProvider::ADMINLOGIN);
    }
}
