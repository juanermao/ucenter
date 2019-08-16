<?php
namespace App\Business\Utils;

class Unique
{
    /**
     * 日志标识
     */
    const LOG_SQL  = '[SQL]';
    const LOG_CURL = '[CURL]';



    /**
     * 错误码
     */
    const CODE_DEFAULT         = 400;           // 全局未知道错误
    const CODE_INVALID_PARAM   = 4001;          // 参数错误
    const CODE_USER_NO_LOGIN   = 401;
    const ERR_USER_NO_LOGIN    = '请先登录';

    const CODE_USERNAME_EXIST  = 1001;
    const ERR_USERNAME_EXIST   = '用户名已存在';
    const CODE_USERADD_FAIL    = 1002;
    const ERR_USERADD_FAIL     = '注册失败，请稍后重试';
    const CODE_CHSMS_NOTEXIST  = 1003;
    const ERR_CHSMS_NOTEXIST   = '短信通道不存在';
    const CODE_SMS_FAIL        = 1004;
    const ERR_SMS_FAIL         = '发送短信失败，请稍后重试';
    const CODE_SMSTIME_MAX     = 1005;
    const ERR_SMSTIME_MAX      = '短信发送次数超过上限';
    const CODE_SMSTMP_NOTEXIST = 1006;
    const ERR_SMSTMP_NOTEXIST  = '短信模板不存在';
    const CODE_KEY_NOTEXIST    = 1007;
    const ERR_KEY_NOTEXIST     = 'ERR KEY';
    const CODE_SMSCODE_ERR     = 1008;
    const ERR_SMSCODE_ERR      = '短信验证码错误';
    const CODE_USERLOGIN_FAIL  = 1009;
    const ERR_USERLOGIN_FAIL   = '登录失败，请稍后重试';


    /**
     * 其它常量
     */
}