<?php

namespace App\Business\Traits;

/**
 * 统一返回JSON格式
 */
trait RespTrait
{

    public function echoError($errmsg = '服务器繁忙，请稍后再试！', $errno = 400)
    {
        $errno == 0 && $errno = 400; //不允许使用错误码0，0代表成功
        return $this->echoMsg($errmsg, $errno);
    }

    public function echoMsg($errmsg = 'ok', $errno = 0)
    {
        $arr = [
            'errno'  => $errno,
            'errmsg' => $errmsg,
            'time'   => time(),
            'data'   => []
        ];

        return $this->getJson($arr);
    }

    public function echoJson($data = array(), $errmsg = 'ok', $errno = 0)
    {
        $arr = [
            'errno'  => $errno,
            'errmsg' => $errmsg,
            'time'   => time(),
            'data'   => $data
        ];

        return $this->getJson($arr);
    }

    private function getJson(array $arr)
    {
        $resp = response()->json($arr);
        $cb = $this->isJsonp();
        if($cb) {
            $resp = $resp->setCallback($cb);
        }
        return $resp;
    }

    private function isJsonp()
    {
        return isset($_GET['callback'])
            ? $_GET['callback']
            : (isset($_GET['jsoncallback'])
                ? $_GET['jsoncallback']
                : false);
    }

}