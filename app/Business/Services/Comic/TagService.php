<?php
namespace App\Business\Services\Comic;

use App\Business\Models\Comic\Tags;

class TagService
{
    public static function getTags()
    {
        return Tags::getTags();
    }
}