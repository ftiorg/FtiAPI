<?php

namespace App\Http\Controllers;

use App\Mail\NoticeMail;
use Illuminate\Http\Request;
use GuzzleHttp;

class NoticeController extends Controller {

	public function NoticeAdmin( Request $request, $plat = 'wx' ) {
		/*
		 * 通知管理员
		 */
		$request->get( 'text' ) ? $text = $request->get( 'text' ) : $this->response->errorBadRequest( 'need text' );
		$desp = $request->get( 'desp' ) ? $request->get( 'desp' ) : null;
		switch ( $plat ) {
			case 'wx':
				return $this->ServerChan( $text, $desp );
			case 'mail':
				return $this->SmtpMail( $text, $desp );
			default:
				return $this->ServerChan( $text, $desp );
		}
	}

	private function ServerChan( $text, $desp = null ) {
		$client = new GuzzleHttp\Client();
		$res    = $client->request( 'GET', "https://sc.ftqq.com/" . env( 'SC_KEY' ) . ".send?text={$text}&desp={$desp}" );
		if ( $res->getStatusCode() == 200 ) {
			return array( 'status' => json_decode( $res->getBody(), true )['errno'] == 0 ? true : false );
		} else {
			return array( 'status' => false, 'message' => $res->getStatusCode() );
		}
	}

	private function SmtpMail( $text, $desp = null ) {
		try {
			\Mail::to( env( 'ADMIN_MAIL' ) )->send( new NoticeMail( [ 'text' => $text, 'desp' => $desp ] ) );

			return array( 'status' => true );
		} catch ( \Exception $e ) {
			return array( 'status' => false, 'message' => $e->getMessage() );
		}
	}


}
