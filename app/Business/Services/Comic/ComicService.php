<?php
namespace App\Business\Services\Comic;

use App\Business\Keys\ComicKey;
use App\Business\Models\Comic\ComicLists;
use App\Business\Models\Comic\Comics;
use App\Business\Models\Comic\ComicTags;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ComicService
{
    public static function getIndex()
    {

    }

    /**
     * 获取首页的"新作来袭"
     * @param int $size
     * @return array|bool|mixed
     */
    public static function getNewsCome($size = 8)
    {
        list($key, $prefix) = ComicKey::redisNewsCome();
        $comics = Redis::get($key);
        if (! $comics) {
            // 1.数据库中获取
            $comics = self::getNewestCover($size);
            if (! $comics) {
                return false;
            }
            // 2.存入redis中
            Redis::set($key, json_encode($comics), 'EX', $prefix);
        }else {
            $comics = json_decode($comics, true);
            if(json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }
        }

        return $comics;
    }

    // TODO size = 8优化

    /**
     * 获取首页的"热门完结"
     * @param int $start
     * @param int $end
     * @return array|bool
     */
    public static function getHotEndsId($start = 0, $end = 7)
    {
        // redis 使用有序集合对【完结】漫画进行排名
        // score=>1 member=>comic_id
        list($key, $noPrefix) = ComicKey::redisHotEnd();
        $ids = Redis::zrevrange($key, $start, $end);
        if (! $ids) {
            return false;
        }
        // TODO 好么？
        $res = self::getCoverByIds($ids);
        if (! $res) {
            return false;
        }

        return $res;
    }

    /**
     * 获取首页的"本周推荐"
     * @return bool|mixed
     */
    public static function getWeekRecommend()
    {
        // TODO 如果redis内存不够会导致让部分缓存失效，这里会有问题
        // 在后台设置哪些漫画是推荐(直接存入redis)
        list($key, $noPrefix) = ComicKey::redisWeekRecommend();
        $comics = Redis::get($key);
        if (! $comics) {
            // TODO 报警
            return false;
        }

        $res = json_decode($comics, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $res;
    }

    /**
     * 经典必看
     * @return bool|mixed
     */
    public static function getClassic()
    {
        // TODO 如果redis内存不够会导致让部分缓存失效，这里会有问题
        // 在后台设置哪些漫画是推荐(直接存入redis)
        list($key, $noPrefix) = ComicKey::redisClassic();
        $comics = Redis::get($key);
        if (! $comics) {
            // TODO 报警
            return false;
        }

        $res = json_decode($comics, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return false;
        }

        return $res;
    }


    public static function getHighScore()
    {

    }



    /**
     * 根据comic_id获取封面信息
     * @param $ids
     * @param int $size
     * @return array|bool
     */
    public static function getCoverByIds($ids, $size = 8)
    {
        return Comics::getByIds($ids, $size);
    }

    /**
     * 获取最新漫画的封面信息
     * @param int $size
     * @return array|bool
     */
    public static function getNewestCover($size = 8)
    {
        return Comics::getNewest($size);
    }


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