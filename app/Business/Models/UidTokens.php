<?php

namespace App\Business\Models;

use Illuminate\Database\Eloquent\Model;

class UidTokens extends Model
{
    protected $table = 'uid_tokens';

    public static function getTokenByUid($uId)
    {
        $res = static::where(['uid' => $uId])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

    public static function getUidByToken($token)
    {
        $res = static::where(['token' => $token])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

    public static function addToken($uid, $token)
    {
        $model = new static();
        $model->uid = $uid;
        $model->token = $token;
        if (! $model->save()) {
            return false;
        }

        return $model->toArray();
    }

    public static function modifyTokenByUid($uid, $token)
    {
        if(! static::where(['uid' => $uid])->update(['token' => $token]) ) {
            return false;
        }

        return true;
    }

}
