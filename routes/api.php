<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/**
 * 不需要登录的接口
 * 给客户端提供的接口
 */
Route::middleware([])->group(function () {
    // 未登录时的跳转地址
    Route::get('/user/nologin', 'UserController@noLogin')->name('login');
    // 发送短信
    Route::get('/sms/send', 'SmsController@sendCode');
    // 手机号登录
    Route::get('/sms/login', 'UserController@smsLogin');
    // 游客登录
    Route::get('/visitor/login', 'UserController@visitorLogin');
});

/**
 * 给服务端提供的接口
 * TODO 签名，白名单
 * TODO 获取用户信息
 */
Route::middleware([
    'verifySign'
])->group(function () {
    Route::post('/auth/getAccessToken', 'AuthController@getAccessToken');
    Route::post('/auth/userInfo', 'AuthController@getUserInfo');
});

/**
 * 需要登录的接口
 */
Route::middleware('auth:api')->group(function () {
    // 获取用户信息
    Route::get('/user/info', 'UserController@info');
});

/**
 * 测试接口
 */
Route::middleware([])->group(function () {
    Route::post('/test/index', 'TestController@index');
    Route::get('/get/sms/code', 'TestController@getSmsCode');
    Route::get('/third/callback', 'TestController@callback');
});