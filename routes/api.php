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
 */
Route::middleware([])->group(function () {
    // 发送短信
    Route::middleware('throttle:60,1')->get('/sms/send', 'SmsController@sendCode');
    // 手机号登录
    Route::get('/sms/login', 'UserController@smsLogin');
    // 游客登录
    Route::get('/visitor/login', 'UserController@visitorLogin');
});

/**
 * 需要登录的接口
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});