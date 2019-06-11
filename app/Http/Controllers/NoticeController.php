<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;

class NoticeController extends Controller {

	public function NoticeAdmin( Request $request ) {
		/*
		 * 通知管理员
		 */
		$request->get( 'text' ) ? $body = $request->get( 'text' ) : $this->response->errorBadRequest( 'need text' );

		return $this->ServerChan( $body, $request->get( 'title' ) );

	}

	private function ServerChan( $text, $dest = null ) {
		$client = new GuzzleHttp\Client();
		$res    = $client->request( 'GET', "https://sc.ftqq.com/" . env( 'SC_KEY' ) . ".send?text={$text}&dest={$dest}" );
		if ( $res->getStatusCode() == 200 ) {
			return $res->getBody();
		} else {
			return $res->getStatusCode();
		}
	}


}
