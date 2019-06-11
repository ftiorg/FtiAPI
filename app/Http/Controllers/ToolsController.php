<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller {
	public function GetIp() {
		/*
		 * 获取ip
		 */
		return array( 'ip' => $_SERVER['REMOTE_ADDR'] );
	}
}
