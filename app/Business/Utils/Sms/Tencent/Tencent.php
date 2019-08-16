<?php
namespace App\Business\Utils\Sms\Tencent;

use App\Business\Utils\HttpUtil;
use App\Business\Utils\Sms\Tencent\src\SmsSingleSender;
use App\Business\Utils\Unique;
use App\Business\Utils\Util;
use Illuminate\Support\Facades\Log;

/**
 * 腾讯短信文档
 * @see https://cloud.tencent.com/document/api/382/13297
 */
class Tencent
{
    public $appid       = '';
    public $appkey      = '';
    public $type        = 0;
    public $nationCode  = '86';
    public $tempId      = '193151';   // 默认的短信模板

    /**
     * 发送短信
     *
     * @param $tel
     * @param $params
     * @param string $tempId
     * @return bool|mixed
     */
    public function send($tel, $params, $tempId = '')
    {
        $params = $this->getParams($params, $tempId);
        $sms = new SmsSingleSender($this->appid, $this->appkey);
        $res = $sms->sendWithParam($this->nationCode, $tel, $this->tempId, $params['params']);
        $res = json_decode($res, true);
        Log::info('[Tencent MSM]', $res);
        if ($res['result'] == 0 && $res['errmsg'] == 'OK') {
            return $params['code'];
        }

        return false;
    }

    /**
     * 根据短信模板生成对应的参数列表
     *
     * @param $params
     * @param $tempId
     * @return array
     */
    public function getParams($params, $tempId)
    {
        if (! $tempId) {
            $tempId = $this->tempId;
        }

        $res = [];
        $code = Util::msmCode(4);
        switch ($tempId) {
            case '193151' :
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