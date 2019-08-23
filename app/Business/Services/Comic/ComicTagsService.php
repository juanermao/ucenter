<?php
namespace App\Business\Services\Comic;

use App\Business\Models\Comic\ComicModel;
use App\Business\Models\Comic\ComicTagsModel;

class ComicTagsService
{
    public static function comicTags()
    {
        $res = ComicModel::find(1)->comicTags;
        print_r($res);
    }

    public static function page($tagId = 0, $size = 10)
    {
        return ComicModel::page($tagId, $size);
    }

}