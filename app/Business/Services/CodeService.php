<?php
namespace App\Business\Services;

use App\Business\Models\CodeModel;
use App\Business\Utils\Util;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CodeService
{
    public static function setCode($uId)
    {
        $code = Util::randMd5($uId);
        if(! CodeModel::setCode($uId, $code) ) {
            return false;
        }

        return $code;
    }

    public static function getCodeByUid($uId)
    {
        return CodeModel::getCodeByUid($uId);
    }
}