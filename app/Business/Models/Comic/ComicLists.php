<?php

namespace App\Business\Models\Comic;

use App\Business\Utils\Unique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ComicLists extends Model
{
    protected $table = Unique::TABLE_COMICS_LISTS;

}
