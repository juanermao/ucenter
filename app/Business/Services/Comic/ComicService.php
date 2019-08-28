<?php
namespace App\Business\Services\Comic;

use App\Business\Models\Comic\ComicLists;
use App\Business\Models\Comic\Comics;
use App\Business\Models\Comic\ComicTags;

class ComicService
{
    public static function page($tagId = 0, $isFinish = 0)
    {
        return Comics::page($tagId, $isFinish);
    }

    public static function list($comicId, $size = 10)
    {
        $fieldArr = [
            'comic_id',
            'index',
            'title',
            'is_pay'
        ];
        $query = Comics::find($comicId)->comicList()->paginate($size, $fieldArr);
        if (! $query) {
            return false;
        }

        return $query->toArray();
    }

    public static function detail($comicListId)
    {
        $comicList = ComicLists::where(['id' => $comicListId,])
            ->get(['id', 'comic_id', 'index', 'title', 'is_pay', 'point', 'content']);
        if (! $comicList) {
            return false;
        }

        return $comicList->toArray();
    }

}