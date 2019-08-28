<?php

namespace App\Business\Models\Comic;

use App\Business\Utils\Unique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Business\Models\Comic\Tags;
use App\Business\Models\Comic\ComicTags;

class Comics extends Model
{
    protected $table = Unique::TABLE_COMICS;

    public static function page($tagId, $isFinish, $size = 10)
    {
        $where = [];
        $query = DB::table(Unique::TABLE_COMICS . ' as c')
            ->leftJoin(Unique::TABLE_COMIC_TAGS . ' as ct', 'c.id', '=', 'ct.comic_id')
            ->leftJoin(Unique::TABLE_TAGS . ' as t', 't.id', '=', 'ct.tag_id')
            ;

        if (! empty($tagId)) {
            $where['ct.tag_id'] = $tagId;
            $where['t.id']      = $tagId;
        }

        if (! empty($isFinish)) {
            $where['c.is_finish'] = $isFinish;
        }

        $query = $query->where($where)->paginate($size);
        if (! $query) {
            return false;
        }

        return $query->toArray();
    }

    public function comicList()
    {
        return $this->hasMany(ComicLists::class, 'comic_id');
    }
}
