<?php

namespace App\Http\Middleware;

use App\Business\Utils\Unique;
use App\Business\Utils\Util;
use Closure;
use Illuminate\Support\Facades\Log;

class LogHttp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('APP_ENV') !== 'production') {
            header('Access-Control-Allow-Origin:*');
            header('Access-Control-Allow-Methods:GET, POST, PUT, OPTIONS');
            header('Access-Control-Max-Ag:600');
            header('Access-Control-Allow-Headers:Authorization, Content-Type, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With');
        }

        $startTime = Util::microtime();

        $response = $next($request);

        $this->storeLog($request, $response, $startTime);

        return $response;
    }

    private function storeLog($request, $response, $startTime)
    {
        $path = trim($request->path(), '#?');
        $context = [
            'path'     => $path,
            'ip'       => Util::getClientIp(),
            'query'    => $request->json()->all(),
            'response' => $response->content(),
            'cost'     => Util::microtime() - $startTime,
        ];
        Log::critical(Unique::LOG_ACCESS, $context);
    }
}
