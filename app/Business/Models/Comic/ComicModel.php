<?php

namespace App\Business\Models\Comic;

use App\Business\Utils\Unique;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Business\Models\Comic\TagModel;
use App\Business\Models\Comic\ComicTagsModel;

class ComicModel extends Model
{
    protected $table = Unique::TABLE_COMICS;

    public function comicTags()
    {
        return $this->hasMany(ComicTagsModel::class, 'comic_id', 'id');
    }

    public static function page($tagId = 0, $size)
    {
        $where = [];
        if (! empty($tagId)) {
            $where['ct.tag_id'] = $tagId;
        }

        $res = DB::table('comics as c')
            ->leftJoin('comic_tags as ct', 'c.id', '=', 'ct.comic_id')
            ->where($where)
            ->paginate($size);
        if (! $res) {
            return false;
        }

        return $res->toArray();
    }

}
