<?php

namespace App\Http\Controllers;

use App\Business\Services\AuthService;
use App\Business\Services\SmsService;
use App\Business\Services\UserService;
use App\Business\Utils\Unique;
use App\Business\Utils\Util;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function smsLogin(Request $request)
    {
        $rules = [
            'tel'  => 'required|min:11',
            'code' => 'required'
        ];
        $message = [
            'tel.required'  => '手机号必须',
            'tel.min'       => '手机号长度不能小于11',
            'code.required' => '验证码必须',
        ];
        $inputs = $this->formValidate($request->all(), $rules, $message);
        // 1.校验验证码
        if(! SmsService::getInstance()->verifyCode($inputs['tel'], $inputs['code'], true) ) {
            throw new \LogicException(Unique::ERR_SMSCODE_ERR ,Unique::CODE_SMSCODE_ERR);
        }

        // 2.注册 or 登录
        $isExist = UserService::getUserByTel($inputs['tel']);
        if(! UserService::getUserByTel($inputs['tel'])) {
            $userInfo = UserService::addUser($inputs, UserService::USER_ADD_TEL);
        }else{
            $userInfo = UserService::saveLoginInfo($isExist);
        }

        if (! $userInfo) {
            throw new \LogicException(Unique::ERR_USERLOGIN_FAIL, Unique::CODE_USERLOGIN_FAIL);
        }

        // 3.获取code
        $code = AuthService::getCode($userInfo['id']);
        if (! $code) {
            throw new \LogicException(Unique::ERR_USERLOGIN_CODE, Unique::CODE_USERLOGIN_CODE);
        }

        $userInfo['code'] = $code;
        return $this->echoJson($userInfo);
    }

    public function visitorLogin(Request $request)
    {
        // 1.获取游客信息
        $visitor = $request->cookie('ucenter_visitor');
        $isExist = UserService::getUserByVisitor($visitor);

        // 2.注册 or 登录
        if (! $isExist) {
            $user['visitor'] = Util::randMd5('visitor');
            $userInfo = UserService::addUser($user, UserService::USER_ADD_VISITOR);
            setcookie('ucenter_visitor', $userInfo['visitor']);
        }else{
            $userInfo = UserService::saveLoginInfo($isExist);
        }

        if (! $userInfo) {
            throw new \LogicException(Unique::ERR_USERLOGIN_FAIL, Unique::CODE_USERLOGIN_FAIL);
        }

        return $this->echoJson($userInfo);
    }

    public function info(Request $request)
    {
        /**
         * Auth::user()
         */
        $userInfo = $request->user()->toArray();
        return $this->echoJson([
            'name'    => $userInfo['name'],
            'tel'     => $userInfo['tel'],
            'visitor' => $userInfo['visitor'],
            'from'    => $userInfo['from'],
        ]);
    }

    public function noLogin(Request $request)
    {
        return $this->echoMsg(Unique::ERR_USER_NO_LOGIN, Unique::CODE_USER_NO_LOGIN);
    }

}
