<?php

namespace App\Http\Controllers;

use App\Business\Services\SmsService;
use App\Business\Utils\Unique;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function sendCode(Request $request)
    {
        $inputs = $request->all();
        $rules  = [
            'tel'  => 'required|max:11|min:11',
        ];
        $message = [
            'tel.required' => '手机号必须',
            'tel.max'      => '手机号长度不能大于11位',
            'tel.min'      => '手机号长度不能小于11位',
        ];
        $inputs = $this->formValidate($inputs, $rules, $message);
        $code = SmsService::getInstance()->sendCode('zhu', $inputs['tel']);
        if (! $code) {
            throw new \LogicException(Unique::ERR_SMS_FAIL, Unique::CODE_SMS_FAIL);
        }

        return $this->echoJson();
    }
}
