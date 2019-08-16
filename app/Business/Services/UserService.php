<?php

namespace App\Business\Services;

use App\Business\Models\ConfigModel;
use App\Business\Models\UserModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UserService
{
    const COOKIE_TOKEN_KEY      = 'api_token';
    const CONFIG_USERNAME_TITLE = 'incr_username';

    /**
     * 注册来源
     * USER_ADD_TEL - 手机号注册
     * USER_ADD_VISITOR - 游客注册
     */
    const USER_ADD_TEL          = 1;
    const USER_ADD_VISITOR      = 2;

    public static function addUser($user, $from)
    {
        $userInfo = [];
        $user['from'] = $from;
        switch ($from){
            case self::USER_ADD_TEL:
                $user['name'] = self::getRandName();
                $userInfo = UserModel::addTelUser($user);
                break;
            case self::USER_ADD_VISITOR:
                $user['name'] = self::getRandName();
                $userInfo = UserModel::addVisitorUser($user);
                break;
            default:
                break;
        }

        if (! $userInfo) {
            return false;
        }

        $user = self::saveLoginInfo($userInfo);
        if(! $user){
            return false;
        }

        return $user;
    }

    public static function saveLoginInfo($userInfo)
    {
        $user = UserModel::getUserById($userInfo['id']);
        if (! empty($user['api_token'])) {
            self::clearCacheToken($user['api_token']);
        }

        $token = md5( sprintf('%d#%s#%d', $user['id'], $user['name'], time()) );
        if (! UserModel::setTokenById($user['id'], $token)) {
            return false;
        }

        $res['id']          = $user['id'];
        $res['name']        = $user['name'];
        $res['tel']         = $user['tel'];
        $res['visitor']     = $user['visitor'];
        $res['api_token']   = $token;
        if (! self::setCacheToken($token, $res)) {
            return false;
        }

        return $res;
    }

    /**
     * 设置缓存、cookie中的api_token
     *
     * @param $token
     * @param $userInfo
     * @return mixed
     */
    public static function setCacheToken($token, $userInfo)
    {
        $expire = 60 * 60 * 24 * 30;     // 30天有效期（单位:秒）
        setcookie(self::COOKIE_TOKEN_KEY, $token, time() + $expire, '/');
        return Redis::set(self::getTokenKey($token), json_encode($userInfo), 'EX', $expire);
    }

    /**
     * 清除缓存中、cookie的api_token
     *
     * @param $token
     * @return mixed
     */
    public static function clearCacheToken($token)
    {
        setcookie(self::COOKIE_TOKEN_KEY, '', time() - 1, '/');
        return Redis::del(self::getTokenKey($token));
    }

    public static function getRandName()
    {
        $incrId = ConfigModel::getConfigByTitle(self::CONFIG_USERNAME_TITLE);
        if (! $incrId) {
            return null;
        }

        return '喵星人_' . $incrId;
    }

    /**
     * 获取api_token的key
     *
     * @param $token
     * @return string
     */
    public static function getTokenKey($token){
        return "api_token:{$token}";
    }

    /**
     * 根据手机号获取用户
     *
     * @param $tel
     * @return mixed
     */
    public static function getUserByTel($tel){
        return UserModel::getUserByTel($tel);
    }

    /**
     * 根据用户名获取用户
     *
     * @param $name
     * @return mixed
     */
    public static function getUserByName($name)
    {
        return UserModel::getUserByName($name);
    }

    /**
     * 根据游客标识获取用户
     *
     * @param $visitor
     * @return bool
     */
    public static function getUserByVisitor($visitor)
    {
        return UserModel::getUserByVisitor($visitor);
    }
}
