<?php

namespace App\Business\Models;

use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    protected $table = 'configs';

    public static function getConfigByTitle($title)
    {
        $model = new static();
        $res = $model::where(['title' => $title])->first();
        if (! $res) {
            return false;
        }

        $res = $res->toArray();
        if (! $model::where(['id' => $res['id']])->increment('value', 1)){
            return false;
        }

        return $res['value'];
    }
}
