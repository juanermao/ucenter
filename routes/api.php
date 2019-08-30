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
 * TODO 缓存用户信息
 * TODO CDN，阿里云，七牛
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

    /**
     * 漫画相关接口
     */
    // 获取漫画分类
    Route::get('/comic/tags', 'Comic\ComicController@getTags');
    // 获取漫画的分页信息
    Route::get('/comic/page', 'Comic\ComicController@page');
    // 获取某漫画的章节信息
    Route::get('/comic/list', 'Comic\ComicController@list');
    // 获取某章节的详细信息
    Route::get('/comic/detail', 'Comic\ComicController@detail');
    // 获取首页所有信息
    Route::get('/comic/index', 'Comic\ComicController@getIndexComic');
});

/**
 * 自测试使用接口
 */
Route::middleware([])->group(function () {
    Route::post('/test/index', 'TestController@index');
    Route::get('/get/sms/code', 'TestController@getSmsCode');
    Route::get('/third/callback', 'TestController@callback');

    Route::get('/test/tags', 'TestController@getComicTags');
});