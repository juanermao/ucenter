<?php

namespace App\Http\Controllers;

use App\Business\Models\Comic\Comics;
use App\Business\Models\Comic\ComicTags;
use App\Business\Models\Comic\Tags;
use App\Business\Services\AuthService;
use App\Business\Services\SmsService;
use App\Business\Utils\HttpUtil;
use App\Business\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\App;

class TestController extends Controller
{
    /**
     * @param Request $request
     * 测试mysql、redis等服务、配置是否正常
     */
    public function index(Request $request)
    {
        // mysql
        $users = DB::table('users')->get();
        print_r($users);

        // redis
        $key = Redis::get('key');
        print_r($key);

        // 确定当前环境
        $environment = App::environment();
        print_r($environment);
        print_r(env('APP_ENV'));

        echo date('Y-m-d H:i:s');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     * 用于"模拟发送手机验证码"后直接获取到对应的验证码
     */
    public function getSmsCode(Request $request)
    {
        $rules = [
            'tel' => 'required'
        ];
        $message = [
            'tel.required' => '手机号必须'
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        $code = SmsService::getInstance()->getCode($inputs['tel']);
        return $this->echoJson(['code' => $code]);
    }

    /**
     * @param Request $request
     * auth 测试
     */
    public function callback(Request $request)
    {
        $rules = [
            'code' => 'required',
        ];
        $message = [
            'code.required' => 'code必须',
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        $url = env('APP_URL') . '/api/auth/getAccessToken';
        $params = [
            'code'  => $inputs['code'],
            'appid' => 'test',
            'ts'    => time(),
        ];
        $params['sign'] = Util::genSign($params, '123456');
        $res = HttpUtil::post($url, $params);
        $res = json_decode($res, true);
        print_r($res);
        if ($res['errno'] != 0) {
            die;
        }

        $accessToken = $res['data']['access_token'];
        $url2 = env('APP_URL') . '/api/auth/userInfo';
        $params2 = [
            'access_token' => $accessToken,
            'ts'           => time(),
            'appid'        => 'test',
        ];
        $params2['sign'] = Util::genSign($params2, '123456');
        $res2 = HttpUtil::post($url2, $params2);
        print_r(json_decode($res2, true));
    }

    /**
     * 关联模型的使用
     */
    public function getComicTags()
    {

    }
}
