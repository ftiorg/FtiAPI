<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller {
	function getTest( Request $request ) {
		return array( 1, 2, 3 );
	}
}
