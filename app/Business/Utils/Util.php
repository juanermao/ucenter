<?php

namespace App\Business\Utils;

class Util
{
    public static function microtime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

    public static function msmCode($length = 4)
    {
        $char = '1234567890';
        $charLen = strlen($char);
        $str = '';
        for ($i = 0; $i < $length; $i++){
            $str .= $char[mt_rand(0, $charLen - 1)];
        }

        return $str;
    }

    public static function getClientIp()
    {
        if(isset($_SERVER['HTTP_X_REAL_IP'])) {
            return $_SERVER['HTTP_X_REAL_IP'];
        }

        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return array_shift($ips);
        }

        if(isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public static function randMd5($str = '')
    {
        return md5($str . microtime() . mt_rand());
    }

}