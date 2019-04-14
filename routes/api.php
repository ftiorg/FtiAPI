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

$api = app( 'Dingo\Api\Routing\Router' );

$api->version( 'v1', [
	'namespace'  => 'App\Http\Controllers',
	'middleware' => [ 'log' ]
], function ( $api ) {
	$api->get( 'test', 'TestController@getTest' );
	/*
	 * user API 测试用
	 */
	$api->get( 'user', 'UserController@index' );
	$api->get( 'user/{id}', 'UserController@show' );
	/*
	 * proxy API 代理访问
	 */
	$api->get( 'proxy', 'ProxyController@ProxyHttpGet' );
	$api->get( 'proxy/{origin}', 'ProxyController@ProxyHttpGet' );
} );
