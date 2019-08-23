<?php

namespace App\Business\Models\Comic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagModel extends Model
{
    protected $table = 'tags';

    public static function getTags()
    {
        $res = static::all(['id', 'name']);
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }
}
