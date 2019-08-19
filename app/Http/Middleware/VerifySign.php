<?php

namespace App\Http\Middleware;

use App\Business\Services\DeveloperService;
use App\Business\Utils\Unique;
use App\Business\Utils\Util;
use Closure;
use App\Business\Traits\ValidateTrait;

class VerifySign
{

    use ValidateTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->work($request);
        return $next($request);
    }

    public function work($request)
    {
        $rules = [
            'appid' => 'required',
            'sign'  => 'required',
        ];
        $message = [
            'appid.required' => 'appid必须',
            'sign.required'  => 'sign必须',
        ];
        $this->formValidate($request->all(), $rules, $message);

        $inputs = $request->all();
        $sign = $inputs['sign'];
        unset($inputs['sign']);

        $developer = DeveloperService::getDeveloperByAppid($inputs['appid']);
        if (! $developer ) {
            throw new \LogicException(Unique::ERR_APPID_INVALID, Unique::CODE_APPID_INVALID);
        }

        if(! Util::verifySign($inputs, $developer['app_secret'], $sign) ) {
            throw new \LogicException(Unique::ERR_SIGN_FAIL, Unique::CODE_SIGN_FAIL);
        }

        return true;
    }

}
