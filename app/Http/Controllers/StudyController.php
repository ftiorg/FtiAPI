<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WordList;

class StudyController extends Controller {
	public function GetWord( Request $request ) {
		$num = ( $request->get( 'n' ) && $request->get( 'n' ) > 1 ) ? $request->get( 'n' ) : 1;
		$all = WordList::all();
		$res = [];
		for ( $i = 0; $i < $num; $i ++ ) {
			if ( in_array( $all[ $rand = mt_rand( 0, $all->count() ) ], $res ) ) {
				$i --;
				continue;
			}
			array_push( $res, $all[ $rand ] );
		}

		sort( $res );

		return $res;
	}
}
