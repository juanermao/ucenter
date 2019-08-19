<?php
namespace App\Business\Services;

use App\Business\Utils\Util;
use Illuminate\Support\Facades\Redis;

class AuthService
{
    const CODE_PREFIX = 10;      // code的有效期，单位：分
    const TOKEN_PREFIX = 60 * 24 * 30;      // token的有效期，单位：分

    public static function getCode($uId)
    {
        $code = Util::randMd5($uId);
        if (! self::setCode($uId, $code) ) {
            return false;
        }

        return $code;
    }

    public static function getToken($code)
    {
        $token = Util::randMd5($code);
        $uId = self::getCodeUid($code, true);
        if (! $uId) {
            return false;
        }

        $userInfo = UserService::getUserById($uId);
        if (! $userInfo) {
            return false;
        }

        if(! self::setToken($token, $userInfo) ){
            return false;
        }

        return $token;
    }

    public static function verifyCode($code)
    {
        $key = self::getCodeKey($code);
        $uId = Redis::get($key);
        if (! $uId ) {
            return false;
        }

        return $uId;
    }

    public static function setCode($uId, $code)
    {
        $prefix = self::CODE_PREFIX * 60;
        $key = self::getCodeKey($code);
        return Redis::set($key, $uId, 'EX', $prefix);
    }

    public static function getCodeUid($code, $isDel = false)
    {
        $key = self::getCodeKey($code);
        $uId = Redis::get($key);
        if ($isDel) {
            self::delCode($code);
        }

        return $uId;
    }

    public static function delCode($code)
    {
        $key = self::getCodeKey($code);
        return Redis::del($key);
    }

    public static function setToken($token, $userInfo)
    {
        $prefix = self::TOKEN_PREFIX * 60;
        $key = self::getTokenKey($token);
        return Redis::set($key, json_encode($userInfo), 'EX', $prefix);
    }

    public static function getCodeKey($code)
    {
        return "authCode:{$code}";
    }

    public static function getTokenKey($token)
    {
        return "authToken:{$token}";
    }
}