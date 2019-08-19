<?php

namespace App\Http\Controllers;

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
    //
    public function index()
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

    public function getSmsCode(Request $request)
    {
        $rule = [
            'tel' => 'required'
        ];
        $message = [
            'tel.required' => '手机号必须'
        ];
        $inputs = $this->formValidate($request->input(), $rule, $message);
        $code = SmsService::getInstance()->getCode($inputs['tel']);
        return $this->echoJson(['code' => $code]);
    }

    public function callback(Request $request)
    {
        $rule = [
            'code' => 'required',
        ];
        $message = [
            'code.required' => 'code必须',
        ];
        $inputs = $this->formValidate($request->input(), $rule, $message);
        $url = env('APP_URL') . '/api/auth/getAccessToken';
        $params = [
            'code'  => $inputs['code'],
            'appid' => 'test',
        ];
        $params['sign'] = Util::genSign($params, '123456');
        $res = HttpUtil::post($url, $params);
        print_r($res);
    }
}
