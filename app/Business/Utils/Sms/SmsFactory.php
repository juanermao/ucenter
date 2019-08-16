<?php
namespace App\Business\Utils\Sms;

use App\Business\Utils\Unique;

class SmsFactory
{
    public static $channel = [
        'tencent' => 'App\\Business\\Utils\\Sms\\Tencent\\Tencent',
        'zhu'     => 'App\\Business\\Utils\\Sms\\Zwj\\Zhu',
    ];

    public static $instance_list = [];

    private function __construct()
    {

    }

    public static function getInstance($ch)
    {
        $class = self::checkChannel($ch);
        if (! isset(self::$instance_list[$ch])) {
            self::$instance_list[$ch] = new $class;
        }

        return self::$instance_list[$ch];
    }

    public static function checkChannel($ch)
    {
        if (! isset( self::$channel[$ch] ) || empty( self::$channel[$ch] )) {
            throw new \LogicException(Unique::ERR_CHSMS_NOTEXIST, Unique::CODE_CHSMS_NOTEXIST);
        }

        return self::$channel[$ch];
    }

    private function __clone()
    {

    }
}