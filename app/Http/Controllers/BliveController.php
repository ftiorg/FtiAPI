<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BliveSign;

class BliveController extends Controller {

	public function SignAll() {
		/*
		 * 整个签到表
		 * @return array
		 */
		return BliveSign::all();
	}

	public function SignInfo( Request $request ) {
		/*
		 * 获取一个用户的签到情况
		 * @param int $uid
		 * @return array
		 */
		$uid = $request->get( 'uid' ) ? $request->get( 'uid' ) : 0;

		return BliveSign::where( 'uid', '=', $uid )->get();
	}

	public function SignInday( Request $request ) {
		/*
		 * 获取某一天的签到情况
		 * @param string $date
		 * @return array
		 */
		$date = ( $request->get( 'date' ) && preg_match( '/\d{4}-\d{2}-\d{2}/', $request->get( 'date' ) ) ) ? $request->get( 'date' ) : date( 'Y-m-d' );

		return BliveSign::where( 'date', '=', $date )->get();
	}

	public function SignOverview() {
		/*
		 * 签到概览
		 * @return array
		 */
		$all  = $this->SignAll();
		$data = [
			'SignCount'     => $all->count(),
			'UserCount'     => 0,
			'UserList'      => [],
			'SignTimeCount' => [
				1  => 0,
				2  => 0,
				3  => 0,
				4  => 0,
				5  => 0,
				6  => 0,
				7  => 0,
				8  => 0,
				9  => 0,
				10 => 0,
				11 => 0,
				12 => 0,
				13 => 0,
				14 => 0,
				15 => 0,
				16 => 0,
				17 => 0,
				18 => 0,
				19 => 0,
				20 => 0,
				21 => 0,
				22 => 0,
				23 => 0
			],
			'SignUserCount' => [

			]
		];
		foreach ( $all as $item ) {
			if ( ! in_array( $item['uid'], $data['UserList'] ) ) {
				array_push( $data['UserList'], $item['uid'] );
				$data['UserCount'] ++;
				$data['SignUserCount'][ $item['uid'] ] = 0;
			}
			$data['SignUserCount'][ $item['uid'] ] ++;
			$data['SignTimeCount'][ (int) substr( $item['time'], 0, 2 ) ] ++;
		}

		return $data;
	}

	public function SignStatistice() {
		/*
		 * 签到统计
		 * @return array
		 */
		//$all = $this->SignAll();

		return [];
	}
}
