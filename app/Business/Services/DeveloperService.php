<?php
namespace App\Business\Services;

use App\Business\Models\DeveloperConfigs;

class DeveloperService
{
    public static function getDeveloperByAppid($appid)
    {
        return DeveloperConfigs::getDeveloperByAppid($appid);
    }
}