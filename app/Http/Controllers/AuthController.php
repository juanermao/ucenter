<?php
namespace App\Http\Controllers;

use App\Business\Services\AuthService;
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
        $rule = [
            'appid' => 'required',
            'code'  => 'required',
        ];
        $message = [
            'appid.required' => 'appid 必须',
            'code.required'  => 'code 必须',
        ];
        $inputs = $this->formValidate($request->all(), $rule, $message);
        if (! AuthService::verifyCode($inputs['code']) ) {
            throw new \LogicException(Unique::ERR_VERIFYCODE_FAIL, Unique::CODE_VERIFYCODE_FAIL);
        }

        $token = AuthService::getToken($inputs['code']);
        if (! $token) {
            throw new \LogicException(Unique::ERR_GETTOKEN_FAIL, Unique::CODE_GETTOKEN_FAIL);
        }

        return $this->echoJson([
            'access_token' => $token
        ]);
    }
}