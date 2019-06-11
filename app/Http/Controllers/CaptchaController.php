<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptchaController extends Controller {
	public function captcha() {
		/*
		 * 验证码
		 */
		return response( captcha() )->header( 'Content-Type', 'image/png' );
	}
}
