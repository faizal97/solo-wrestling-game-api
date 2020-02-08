<?php

namespace App\Models\Helpers;

use App\Models\User;

class UserHelper extends User
{

    public static function findByEmail($email)
    {
        return self::where('email', '=', $email)->first();
    }

    public static function findByApiToken($apiToken)
    {
        return self::where('api_token', '=', $apiToken)->first();
    }
}