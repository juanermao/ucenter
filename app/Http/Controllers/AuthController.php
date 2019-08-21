<?php
namespace App\Http\Controllers;

use App\Business\Services\AuthService;
use App\Business\Services\CodeService;
use App\Business\Services\DeveloperService;
use App\Business\Services\TokenService;
use App\Business\Utils\Unique;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth');
    }

    public function getAccessToken(Request $request)
    {
        $rules = [
            'appid' => 'required',
            'code'  => 'required',
        ];
        $message = [
            'appid.required' => 'appid 必须',
            'code.required'  => 'code 必须',
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        if (! CodeService::verifyCode($inputs['code']) ) {
            throw new \LogicException(Unique::ERR_VERIFYCODE_FAIL, Unique::CODE_VERIFYCODE_FAIL);
        }

        $token = TokenService::getToken($inputs['code']);
        if (! $token) {
            throw new \LogicException(Unique::ERR_GETTOKEN_FAIL, Unique::CODE_GETTOKEN_FAIL);
        }

        return $this->echoJson([
            'access_token' => $token
        ]);
    }

    public function getUserInfo(Request $request)
    {
        $rules = [
            'access_token' => 'required',
        ];
        $message = [
            'access_token.required' => 'access_token 必须',
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        $userInfo = TokenService::verifyToken($inputs['access_token']);
        if (! $userInfo) {
            throw new \LogicException(Unique::ERR_TOKEN_FAIL, Unique::CODE_TOKEN_FAIL);
        }

        return $this->echoJson($userInfo);
    }

}