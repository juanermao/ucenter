<?php
namespace App\Business\Services\Comic;

use App\Business\Models\Comic\TagModel;

class TagService
{
    public static function getTags()
    {
        return TagModel::getTags();
    }
}