<?php
namespace App\Business\Services;

use App\Business\Models\DeveloperModel;

class DeveloperService
{
    public static function getDeveloperByAppid($appid)
    {
        return DeveloperModel::getDeveloperByAppid($appid);
    }
}