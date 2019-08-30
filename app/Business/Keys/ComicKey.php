<?php
namespace App\Business\Keys;

class ComicKey
{
    const MINUTE_SECOND = 60;
    const HOUR_SECOND   = 3600;
    const DAY_SECOND    = 86400;
    const WEEK_SECOND   = 604800;


    /**
     * 新作来袭
     * @return array
     */
    public static function redisNewsCome()
    {
        return [
            'newsCome:comics',
            self::DAY_SECOND
        ];
    }

    /**
     * 热门完结
     * @return array
     */
    public static function redisHotEnd()
    {
        return [
            'hotEnd:comics',
            null
        ];
    }

    /**
     * 本周推荐
     * @return array
     */
    public static function redisWeekRecommend()
    {
        return [
            'recommend:comics',
            null
        ];
    }

    /**
     * 经典必看
     * @return array
     */
    public static function redisClassic()
    {
        return [
            'classic:comics',
            null
        ];
    }

    /**
     * 高分作品
     * @return array
     */
    public static function redisHighScore()
    {
        return [
            'highScore:comics',
            self::DAY_SECOND
        ];
    }

    /**
     * 人气连载
     * @return array
     */
    public static function redisHotSerial()
    {
        return [
            'hotSerial:comics',
            self::DAY_SECOND
        ];
    }
}