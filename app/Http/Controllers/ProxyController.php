<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;

class ProxyController extends Controller {
	function ProxyHttpGet( Request $request, $origin = 'cn' ) {

		! empty( $url = $request->get( 'url' ) ) ?: $this->response->errorNotFound( 'need a url' );
		preg_match( '/^(?:([A-Za-z]+):)?(\/{0,3})([0-9.\-A-Za-z]+)(?::(\d+))?(?:\/([^?#]*))?(?:\?([^#]*))?(?:#(.*))?$/', $url, $matches ) ?: $this->response->errorNotFound( 'not true url' );
		in_array( $matches[3], $this->WhiteHost() ) ?: $this->response->errorNotFound( 'cant access this host' );
		$params = $request->all();
		unset( $params['url'] );
		foreach ( $params as $key => $value ) {
			$url = $url . '&' . $key . '=' . $value;
		}
		$client = $this->HttpClient();
		try {
			$res = $client->get( $url );
		} catch ( \Exception $e ) {
			$this->response->errorNotFound( $e->getMessage() );
		}

		return $res->getBody();
	}

	private function HttpClient( $config = [] ) {
		$default = [
			'timeout' => 5.0,
			'verify'  => false,
			'headers' => [
				'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36',
			]
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
			'cloud.aikamino.cn',
			'space.bilibili.com',
			'www.google.com',
		];
	}

	private function ProxyServer() {
		return [
			'us' => 'https://proxy.example/'
		];
	}
}
