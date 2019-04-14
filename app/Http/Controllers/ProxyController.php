<?php

namespace App\Http\Controllers;

use App\Transformers\RawTransformer;
use Illuminate\Http\Request;
use GuzzleHttp;
use App\Log;

class ProxyController extends Controller {
	function ProxyHttpGet( Request $request, $origin = 'cn' ) {

		! empty( $url = $request->get( 'url' ) ) ?: $this->response->errorNotFound( 'need a url' );
		preg_match( '/^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/', $url, $matches ) ?: $this->response->errorNotFound( 'not true url' );
		in_array( $matches[3], $this->WhiteHost() ) ?: $this->response->errorNotFound( 'cant access this host' );

		if ( $origin != 'cn' ) {
			@$ProxyServer = array_key_exists( $origin, $this->ProxyServer() ) ? $this->ProxyServer()[ $origin ] : $this->response->errorNotFound( 'no proxy server' );
		}
		$client = $this->HttpClient();
		try {
			$res = $client->get( $url );
		} catch ( \Exception $e ) {
			$this->response->error( $e->getMessage(), $e->getCode() );
		}
		header( 'Content-Type: application/json' );

		return $res->getBody();
	}

	private function HttpClient( $config = [] ) {
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

	private function WhiteHost() {
		return [
			'115.159.208.124',
			'cloud.aikamino.cn',
			'www.baidu.com',
		];
	}

	private function ProxyServer() {
		return [
			'us' => 'https://proxy.example/'
		];
	}
}
