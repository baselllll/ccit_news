<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next = null, $guard = null)
    {
        \Illuminate\Support\Facades\Config::set('auth.defaults.guard', 'admin');
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }else{
            return redirect(RouteServiceProvider::ADMINLOGIN);
        }
    }
}
