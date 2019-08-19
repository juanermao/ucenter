<?php
namespace App\Business\Services;

use App\Business\Utils\Util;

class AuthService
{
    public static function getCode($userId)
    {
        $code = Util::randMd5($userId);

    }
}