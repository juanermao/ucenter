<?php

namespace App\Business\Models;

use App\Business\Services\UserService;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    public static function setTokenById($id, $token)
    {
        if (! static::where(['id' => $id])->update(['api_token' => $token])) {
            return false;
        }

        return $token;
    }

    public static function addTelUser($user)
    {
        $model = new static();
        $model->name = $user['name'];
        $model->tel = $user['tel'];
        $model->from = $user['from'];
        if (! $model->save()) {
            return false;
        }

        return $model->toArray();
    }

    public static function addVisitorUser($user)
    {
        $model = new static();
        $model->name = $user['name'];
        $model->visitor = $user['visitor'];
        $model->from = $user['from'];
        if (! $model->save()) {
            return false;
        }

        return $model->toArray();
    }

    public static function getUserById($id)
    {
        $res = static::where(['id' => $id])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();

    }

    public static function getUserByTel($tel)
    {
        $res = static::where(['tel' => $tel])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

    public static function getUserByName($name)
    {
        $res = static::where(['name' => $name])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

    public static function getUserByVisitor($visitor)
    {
        $res = static::where(['visitor' => $visitor])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }
}
