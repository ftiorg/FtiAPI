<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;

class ProxyController extends Controller {
	function ProxyHttpGet( Request $request, $url = 'https://www.baidu.com/' ) {
		try {
			$result = $this->client()->get( $url );
			$result->getHeader( 'Content-Type' );

			return $result->getHeader( 'Content-Type' );
		} catch ( \Exception $e ) {
			$this->response->error( "can't access {$url}", 200 );
		}

		return null;
	}

	function client( $config = [] ) {
		$default = [
			'timeout' => 5.0,
			'verify'  => false
		];
		foreach ( $config as $value ) {
			if ( ! in_array( $value, $default ) ) {
				array_push( $config, $value );
			}
		}

		return new GuzzleHttp\Client( $config );
	}
}
