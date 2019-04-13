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
	$api->get( 'get', 'TestController@getTest' );
	$api->get( 'proxy/get/', 'ProxyController@ProxyHttpGet' );
	$api->get( 'proxy/get/{url}', 'ProxyController@ProxyHttpGet' );
} );