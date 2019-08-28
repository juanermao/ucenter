<?php
namespace App\Business\Services;

use App\Business\Models\UidCodes;
use App\Business\Models\UidTokens;
use App\Business\Utils\Util;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TokenService
{
    // token有效期，单位：天
    const TOKEN_EXPIRE_DAY = 1;

    public static function getToken($code)
    {
        $token = Util::randMd5($code);
        $codeRes = CodeService::getUidByCode($code);
        if (! $codeRes) {
            return false;
        }

        $uId = $codeRes['uid'];
        $userRes = UserService::getUserById($uId);
        if (! $userRes) {
            return false;
        }

        $tokenRes = UidTokens::getTokenByUid($uId);
        if (! $tokenRes) {
            // 添加
            $res = UidTokens::addToken($uId, $token);
        }else{
            // 修改
            $res = UidTokens::modifyTokenByUid($uId, $token);
        }

        if (! $res) {
            return false;
        }

        // 删除code
        CodeService::delCodeById($codeRes['id']);
        return $token;
    }

    public static function verifyToken($token)
    {
        // 1.校验token
        $tokenRes = self::getUidByToken($token);
        if (! $tokenRes) {
            return false;
        }

        // 2.校验token有效期
        $ts = strtotime( $tokenRes['updated_at'] );
        if ( time() - $ts >  (self::TOKEN_EXPIRE_DAY * 60 * 60 * 24) ) {
            return false;
        }

        $uId = $tokenRes['uid'];
        // 获取用户信息
        $userInfo = UserService::getUserById($uId);
        if (! $userInfo) {
            return false;
        }

        $res['id']          = $userInfo['id'];
        $res['name']        = $userInfo['name'];
        $res['tel']         = $userInfo['tel'];
        $res['visitor']     = $userInfo['visitor'];
        return $res;
    }

    public static function getUidByToken($token)
    {
        return TokenService::getUidByToken($token);
    }
}