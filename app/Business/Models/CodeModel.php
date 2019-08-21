<?php

namespace App\Business\Models;

use App\Business\Services\UserService;
use Illuminate\Database\Eloquent\Model;

class CodeModel extends Model
{
    protected $table = 'uid_codes';

    public static function getCodeByUid($uId)
    {
        $res = static::where(['uid' => $uId])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

    public static function getUidByCode($code)
    {
        $res = static::where(['code' => $code])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

    public static function addCode($uid, $code)
    {
        $model = new static();
        $model->uid = $uid;
        $model->code = $code;
        if (! $model->save()) {
            return false;
        }

        return $model->toArray();
    }

    public static function modifyCodeByUid($uid, $code)
    {
        return static::where(['uid' => $uid])->update(['code' => $code]);
    }

    public static function delCodeById($id)
    {
        return static::where(['id' => $id])->delete();
    }

}
