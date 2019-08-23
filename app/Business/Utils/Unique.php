<?php
namespace App\Business\Utils;

class Unique
{
    /**
     * 数据表标识
     */
    const TABLE_COMICS           = 'comics';
    const TABLE_COMICS_LISTS     = 'comic_lists';
    const TABLE_COMIC_TAGS       = 'comic_tags';
    const TABLE_TAGS             = 'tags';


    /**
     * 日志标识
     */
    const LOG_SQL    = '[SQL]';
    const LOG_CURL   = '[CURL]';
    const LOG_ACCESS = '[ACCESS]';

    /**
     * 错误码
     */
    const CODE_DEFAULT          = 400;           // 全局未知道错误
    const CODE_INVALID_PARAM    = 4001;          // 参数错误
    const CODE_USER_NO_LOGIN    = 401;
    const ERR_USER_NO_LOGIN     = '请先登录';

    const CODE_USERNAME_EXIST   = 1001;
    const ERR_USERNAME_EXIST    = '用户名已存在';
    const CODE_USERADD_FAIL     = 1002;
    const ERR_USERADD_FAIL      = '注册失败，请稍后重试';
    const CODE_CHSMS_NOTEXIST   = 1003;
    const ERR_CHSMS_NOTEXIST    = '短信通道不存在';
    const CODE_SMS_FAIL         = 1004;
    const ERR_SMS_FAIL          = '发送短信失败，请稍后重试';
    const CODE_SMSTIME_MAX      = 1005;
    const ERR_SMSTIME_MAX       = '短信发送次数超过上限';
    const CODE_SMSTMP_NOTEXIST  = 1006;
    const ERR_SMSTMP_NOTEXIST   = '短信模板不存在';
    const CODE_KEY_NOTEXIST     = 1007;
    const ERR_KEY_NOTEXIST      = 'ERR KEY';
    const CODE_SMSCODE_ERR      = 1008;
    const ERR_SMSCODE_ERR       = '短信验证码错误';
    const CODE_USERLOGIN_FAIL   = 1009;
    const ERR_USERLOGIN_FAIL    = '登录失败，请稍后重试';
    const CODE_USERLOGIN_CODE   = 10010;
    const ERR_USERLOGIN_CODE    = '登录失败，请稍后重试[code err]';
    const CODE_VERIFYCODE_FAIL  = 10011;
    const ERR_VERIFYCODE_FAIL   = 'code不存在或者已失效';
    const CODE_GETTOKEN_FAIL    = 10012;
    const ERR_GETTOKEN_FAIL     = '获取access_token失败';
    const CODE_APPID_INVALID    = 10013;
    const ERR_APPID_INVALID     = '无效的appid';
    const CODE_SIGN_FAIL        = 10014;
    const ERR_SIGN_FAIL         = '签名错误';
    const CODE_REDIRECT_INVALID = 10015;
    const ERR_REDIRECT_INVALID  = 'redirect_url 不可用';
    const CODE_TIME_OUT         = 10016;
    const ERR_TIME_OUT          = '请求超时';
    const CODE_TOKEN_FAIL       = 10017;
    const ERR_TOKEN_FAIL        =  'token 错误';

    /**
     * 其它常量
     */
}