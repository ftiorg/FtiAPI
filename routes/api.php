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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers',
    'middleware' => [
        'log',
        'cors'
    ]
], function ($api) {
    $api->get('test', 'TestController@getTest');
    /*
     * user API 测试用
     */
    $api->get('user', 'UserController@index');
    $api->get('user/{id}', 'UserController@show');
    /*
     * proxy API 代理访问
     */
    $api->get('proxy', 'ProxyController@ProxyHttpGet');
    $api->get('proxy/{origin}', 'ProxyController@ProxyHttpGet');
    /*
     * BiliLive API
     */
    //$api->get( 'blive/all', 'BliveController@SignAll' );
    $api->get('blive/info', 'BliveController@SignInfo');
    $api->get('blive/day', 'BliveController@SignInday');
    $api->get('blive/overview', 'BliveController@SignOverview');
    $api->get('blive/rank', 'BliveController@SignRank');
    $api->get('blive/users', 'BliveController@SignUsers');
    $api->get('blive/danmu', 'BliveController@DanmuLog');
    $api->get('blive/gift', 'BliveController@GiftLog');
    $api->get('blive/music/playing', 'BliveController@MusicIsPlaying');
    $api->get('blive/music/next', 'BliveController@MusicNext');
    $api->get('blive/music/will', 'BliveController@MusicWillPlay');
    $api->get('blive/music/add', 'BliveController@MusicAdd');
    /*
     * Study API
     */
    $api->get('study/word', 'StudyController@GetWord');
    /*
     * Captcha
     */
    $api->get('captcha', 'CaptchaController@captcha');
    /*
     * notice
     */
    $api->get('notice', 'NoticeController@NoticeAdmin');
    $api->get('notice/{plat}', 'NoticeController@NoticeAdmin');
    /*
     * tools
     */
    $api->get('tools/ip', 'ToolsController@GetIp');
    /*
     * sign
     */
    $api->post('sign/add', 'SignController@NewSign');
    $api->get('sign/today', 'SignController@TodayRank');
    $api->get('sign/history', 'SignController@SignHistory');
    $api->post('sign/detail', 'SignController@TodayDetail');
    /*
     * qqapp
     */
    $api->post('qqapp/getid', 'QqappController@GetOpenId');
});
