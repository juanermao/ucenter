<?php
namespace App\Business\Services;

use App\Business\Utils\Sms\SmsFactory;
use App\Business\Utils\Unique;
use App\Business\Utils\Util;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class SmsService
{
    private static $instance = null;
    private $prefix = 10;   // 短信验证码有效时间（单位：分）
    private $rule = [
        'smsip'  => 100,
        'smstel' => 10,
    ];

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function sendCode($channel, $tel, $tempId = '')
    {
        // 1.校验
        if (! $this->checkTel($tel) ) {
            throw new \LogicException(Unique::ERR_SMSTIME_MAX, Unique::CODE_SMSTIME_MAX);
        }

        $params['prefix'] = $this->prefix;
        // 2.发送短信
        $code = $this->getSms($channel)->send($tel, $params, $tempId);
        if (! $code) {
            throw new \LogicException(Unique::ERR_SMS_FAIL, Unique::CODE_SMS_FAIL);
        }

        // 3.缓存验证码
        $this->setCode($tel, $code);
        return true;
    }

    /**
     * 校验短信发送频率
     * smsip:同一个IP每天最多可发送100次
     * smstel:同一个手机号每天最多可发送10次
     *
     * @param $tel
     * @return bool
     */
    public function checkTel($tel)
    {
        foreach ($this->rule as $type => $times) {
            $op = $this->getOp($type, $tel);
            $key = $this->getCheckKey($type, $op);
            if ( Redis::get($key) >= $this->rule[$type] ) {
                return false;
            }
        }

        return true;
    }

    /**
     * 缓存验证码、发送次数
     *
     * @param $tel
     * @param $code
     * @return bool
     */
    public function setCode($tel, $code)
    {
        $key = $this->getCodeKey($tel);
        Redis::set($key, $code, 'EX', $this->prefix * 60);
        $this->addTimes($tel);
    }

    /**
     * 缓存发送次数
     *
     * @param $tel
     */
    public function addTimes($tel)
    {
        $expire = strtotime( date('Y-m-d') . ' 23:59:59' ) - time();
        foreach ($this->rule as $type => $times) {
            $op = $this->getOp($type, $tel);
            $key = $this->getCheckKey($type, $op);
            if (! Redis::get($key)) {
                Redis::set($key, 1, 'EX', $expire);
            }else{
                Redis::command('incr', [$key]);
            }
        }
    }

    public function getOp($type, $tel)
    {
        $op = '';
        switch ($type) {
            case 'smsip':
                $op = Util::getClientIp();
                break;
            case 'smstel':
                $op = $tel;
                break;
            default:
                throw new \LogicException(Unique::ERR_KEY_NOTEXIST, Unique::CODE_KEY_NOTEXIST);
                break;
        }

        return $op;
    }

    /**
     * 校对验证码
     *
     * @param $tel
     * @param $code
     * @param $isDel
     * @return bool
     */
    public function verifyCode($tel, $code, $isDel = false)
    {
        if (! ($this->getCode($tel) == $code)) {
            return false;
        }

        if ($isDel) {
            return $this->delCode($tel);
        }

        return true;
    }

    public function delCode($tel){
        return Redis::del($this->getCodeKey($tel));
    }

    /**
     * 获取验证码
     *
     * @param $tel
     * @return mixed
     */
    public function getCode($tel)
    {
        return Redis::get($this->getCodeKey($tel));
    }

    /**
     * 获取对应渠道商（即channel）的发送短信类实例
     *
     * @param $channel
     * @return mixed
     */
    public function getSms($channel)
    {
        return SmsFactory::getInstance($channel);
    }

    /**
     * 获取校验规则对应的redis key
     *
     * @param $type
     * @param $op   {$tel} 或者 {$ip}
     * @return string
     */
    public function getCheckKey($type, $op)
    {
        return "{$type}:{$op}";
    }

    /**
     * 获取短信验证码对应的redis key
     *
     * @param $tel
     * @return string
     */
    public function getCodeKey($tel)
    {
        return "sms:{$tel}";
    }

    private function __clone()
    {

    }
}