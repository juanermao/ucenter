<?php
namespace App\Business\Services;

use App\Business\Models\CodeModel;
use App\Business\Utils\Util;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CodeService
{

    // code的有效期，单位：分
    const CODE_PREFIX_MINUTE = 10;

    public static function getCode($uId)
    {
        $code = Util::randMd5($uId);
        $codeRes = self::getCodeByUid($uId);
        if(! $codeRes ){
            $res = CodeModel::addCode($uId, $code);
        }else{
            $res = CodeModel::modifyCodeByUid($uId, $code);
        }

        if (! $res) {
            return false;
        }

        return $code;
    }

    public static function verifyCode($code)
    {
        // 1.校验code是否存在
        $codeRes = self::getUidByCode($code);
        if (! $codeRes) {
            return false;
        }

        // 2.校验code是否过期
        $ts = strtotime($codeRes['updated_at']);
        if ( time() - $ts > (self::CODE_PREFIX_MINUTE * 60) ) {
            return false;
        }

        return true;
    }

    public static function getCodeByUid($uId)
    {
        return CodeModel::getCodeByUid($uId);
    }

    public static function getUidByCode($code)
    {
        return CodeModel::getUidByCode($code);
    }
}