<?php

namespace App\Http\Middleware;

use App\Business\Utils\Unique;
use Closure;
use App\Business\Traits\ValidateTrait;
use Illuminate\Support\Facades\Log;

class GlobalApi
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
            'ts' => 'required',
        ];
        $message = [
            'ts.required' => 'ts 不能为空',
        ];
        $inputs = $this->formValidate($request->input(), $rules, $message);
        if (time() - $inputs['ts'] > 30) {
            throw new \LogicException(Unique::ERR_TIME_OUT, Unique::CODE_TIME_OUT);
        }

        return true;
    }
}
