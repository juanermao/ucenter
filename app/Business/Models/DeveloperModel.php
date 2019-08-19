<?php

namespace App\Business\Models;

use Illuminate\Database\Eloquent\Model;

class DeveloperModel extends Model
{
    protected $table = 'developer_configs';

    public static function getDeveloperByAppid($appid)
    {
        $res = static::where(['appid' => $appid])->first();
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }
}
