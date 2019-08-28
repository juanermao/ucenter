<?php

namespace App\Business\Models\Comic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;
use App\Business\Models\Comic\Tags;

class ComicTags extends Pivot
{
    public $incrementing = true;
    protected $table     = 'comic_tags';
}
