<?php

namespace App\Http\Controllers;

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
}
