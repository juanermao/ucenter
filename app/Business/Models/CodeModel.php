<?php

namespace App\Business\Models;

use App\Business\Services\UserService;
use Illuminate\Database\Eloquent\Model;

class CodeModel extends Model
{
    protected $table = 'uid_code';

    public static function getCodeByUid($uId)
    {
        $res = static::where(['uid' => $uId])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

    public static function setCode($uId, $code)
    {
        $model = new static();
        $model->uid  = $uId;
        $model->code = $code;
        if (! $model->save()) {
            return false;
        }

        return $model->toArray();
    }

}
