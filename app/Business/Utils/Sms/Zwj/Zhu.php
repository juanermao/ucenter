<?php
namespace App\Business\Utils\Sms\Zwj;

use App\Business\Utils\Unique;
use App\Business\Utils\Util;
use Illuminate\Support\Facades\Log;

/**
 * 假装某个发送短信的渠道
 */
class Zhu
{
    public $tempId      = '1';   // 默认的短信模板

    /**
     * 发送短信
     *
     * @param $tel
     * @param $params
     * @param string $tempId
     * @return mixed
     */
    public function send($tel, $params, $tempId = '')
    {
        $params = $this->getParams($params, $tempId);
        $res['tel'] = $tel;
        $res['tempId'] = $tempId;
        $res = array_merge($res, $params);
        Log::info('[Zhu MSM 模拟短信发送...]', $res);
        return $params['code'];
    }

    /**
     * 根据短信模板生成对应的参数列表
     *
     * @param $params
     * @param $tempId
     */
    public function getParams($params, $tempId){
        if (! $tempId) {
            $tempId = $this->tempId;
        }

        $res = [];
        $code = Util::msmCode(4);
        switch ($tempId) {
            case '1' :
                $res[] = $code;
                $res[] = $params['prefix'];
                break;
            default:
                throw new \LogicException(Unique::ERR_SMSTMP_NOTEXIST, Unique::ERR_SMSTMP_NOTEXIST);
                break;
        }

        return [
            'code'   => $code,
            'params' => $res
        ];
    }
}