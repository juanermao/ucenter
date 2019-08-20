<?php
namespace App\Business\Services;

use App\Business\Utils\Util;
use http\Env\Request;
use Illuminate\Support\Facades\Redis;

class AuthService
{
    const CODE_PREFIX  = 10;                 // code的有效期，单位：分
    const TOKEN_PREFIX = 60 * 24 * 30;       // token的有效期，单位：分

    /**
     * @param $uId
     * @return bool|string
     * 生成一次性code
     */
    public static function setCode($uId)
    {
        $code = Util::randMd5($uId);
        if (! self::cacheCode($uId, $code) ) {
            return false;
        }

        return $code;
    }

    /**
     * @param $code
     * @return bool|string
     * 生成access_token
     */
    public static function setToken($code)
    {
        $token = Util::randMd5($code);
        $uId = self::getUidByCode($code, true);
        if (! $uId) {
            return false;
        }

        $userInfo = UserService::getUserById($uId);
        if (! $userInfo) {
            return false;
        }

        $res['id']          = $userInfo['id'];
        $res['name']        = $userInfo['name'];
        $res['tel']         = $userInfo['tel'];
        $res['visitor']     = $userInfo['visitor'];

        if(! self::cacheToken($token, $res) ){
            return false;
        }

        return $token;
    }

    /**
     * @param $code
     * @return bool
     * 校验code
     */
    public static function verifyCode($code)
    {
        $key = self::getCodeKey($code);
        $uId = Redis::get($key);
        if (! $uId ) {
            return false;
        }

        return $uId;
    }

    /**
     * @param $token
     * @return bool|mixed
     * 校验access_token
     */
    public static function verifyToken($token)
    {
        $key = self::getTokenKey($token);
        $userInfo = Redis::get($key);
        if (! $userInfo) {
            return false;
        }

        return json_decode($userInfo, true);
    }

    /**
     * @param $uId
     * @param $code
     * @return mixed
     * 缓存code
     */
    public static function cacheCode($uId, $code)
    {
        $prefix = self::CODE_PREFIX * 60;
        $key = self::getCodeKey($code);
        return Redis::set($key, $uId, 'EX', $prefix);
    }

    /**
     * @param $token
     * @param $userInfo
     * @return mixed
     * 缓存token
     */
    public static function cacheToken($token, $userInfo)
    {
        $prefix = self::TOKEN_PREFIX * 60;
        $key = self::getTokenKey($token);
        return Redis::set($key, json_encode($userInfo), 'EX', $prefix);
    }

    /**
     * @param $code
     * @param bool $isDel
     * @return mixed
     * 根据code获取对应的用户id
     */
    public static function getUidByCode($code, $isDel = false)
    {
        $key = self::getCodeKey($code);
        $uId = Redis::get($key);
        if ($isDel) {
            self::delCode($code);
        }

        return $uId;
    }

    /**
     * @param $code
     * @return mixed
     * 删除code
     */
    public static function delCode($code)
    {
        $key = self::getCodeKey($code);
        return Redis::del($key);
    }

    /**
     * @param $code
     * @return string
     * 获取code的key
     */
    public static function getCodeKey($code)
    {
        return "authCode:{$code}";
    }

    /**
     * @param $token
     * @return string
     * 获取access_token的key
     */
    public static function getTokenKey($token)
    {
        return "authToken:{$token}";
    }
}