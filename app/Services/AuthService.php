<?php

namespace App\Services;

class AuthService
{
    public $guard;
    public function __construct(string $guard)
    {
        $this->guard = $guard;
    }
    public function authenticate(array $credentials) : bool
    {
//        $fieldType = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
//        $logged = auth()->guard($this->guard)->attempt($credentials);
//        auth()->guard($this->guard)->user()->update(['last_login'=>date('Y-m-d H:i:s')]);
//        return $logged;
        return auth()->guard($this->guard)->attempt($credentials);
    }

    public function logout()
    {
        return auth($this->guard)->logout();
    }
}
