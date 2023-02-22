<?php

namespace App\Services;

class GenerateCodeService
{
    public static function randomCode()
    {
        $characters = '1234567890';
        $pin = mt_rand(10000, 99999)
            . $characters[rand(0, strlen($characters) - 1)];
        $pin = str_shuffle($pin);
        return $pin;
    }
}
