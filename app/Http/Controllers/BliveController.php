<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Promise\queue;
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
		 * 获取一个用户的签到情况 TODO: 改用户名,纯数字name
		 * @param int $uid
		 * @return array
		 */
		$user = $request->get( 'user' ) ? $request->get( 'user' ) : 0;
		if ( is_numeric( $user ) ) {
			$res = BliveSign::where( 'uid', '=', $user )->get();
		} else {
			$who = BliveSign::where( 'name', '=', $user )->orderBy( 'date', 'desc' )->limit( 1 )->get();
			$uid = $who ? $who[0]['uid'] : 0;

			$res = BliveSign::where( 'uid', '=', $uid )->get();
		}
		for ( $i = 0; $i < count( $res ); $i ++ ) {
			$res[ $i ]['id'] = $i + 1;
		}

		return $res;
	}

	public function SignInday( Request $request ) {
		/*
		 * 获取某一天的签到情况
		 * @param string $date
		 * @return array
		 */
		$date = ( $request->get( 'date' ) && preg_match( '/\d{4}-\d{2}-\d{2}/', $request->get( 'date' ) ) ) ? $request->get( 'date' ) : date( 'Y-m-d' );
		$res  = BliveSign::where( 'date', '=', $date )->get();
		$id   = 1;
		foreach ( $res as $key => $value ) {
			$res[ $key ]['rank'] = $id;
			$id ++;
			unset( $res[ $key ]['id'] );
		}

		return $res;
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
			'SignUserCount' => [],
			'SignDayCount'  => []
		];
		foreach ( $all as $item ) {
			if ( ! in_array( $item['uid'], $data['UserList'] ) ) {
				array_push( $data['UserList'], $item['uid'] );
				$data['UserCount'] ++;
				$data['SignUserCount'][ $item['uid'] ] = 0;
			}
			if ( ! array_key_exists( $item['date'], $data['SignDayCount'] ) ) {
				$data['SignDayCount'][ $item['date'] ] = 0;
			}
			$data['SignUserCount'][ $item['uid'] ] ++;
			$data['SignTimeCount'][ (int) substr( $item['time'], 0, 2 ) ] ++;
			$data['SignDayCount'][ $item['date'] ] ++;
		}

		$data['SignTimeCount'] = $this->RewriteArray( $data['SignTimeCount'] );
		$data['SignUserCount'] = $this->RewriteArray( $data['SignUserCount'] );
		$data['SignDayCount']  = $this->RewriteArray( $data['SignDayCount'] );

		return $data;
	}

	public function SignRank() {
		/*
		 * 签到排行榜
		 * @return array
		 */
		$rank = [];
		$res  = [];
		foreach ( $this->SignAll() as $item ) {
			array_key_exists( $item['uid'], $rank ) ?: $rank[ $item['uid'] ] = [ 'times' => 0 ];
			$rank[ $item['uid'] ] = [ 'name' => $item['name'], 'times' => $rank[ $item['uid'] ]['times'] + 1 ];
		}

		foreach ( $rank as $key => $value ) {
			$res[] = [
				'uid'   => $key,
				'name'  => $value['name'],
				'times' => $value['times']
			];
		}

		$rank = $this->SortMultiArray( $res, 'times', true );

		$id              = 1;
		$rank[0]['rank'] = $id;

		for ( $i = 1; $i < count( $rank ); $i ++ ) {
			if ( $rank[ $i ]['times'] != $rank[ $i - 1 ]['times'] ) {
				$id ++;
			}
			$rank[ $i ]['rank'] = $id;
		}

		return $rank;

	}

	public function SignUsers( Request $request ) {
		/*
		 * 获取用户列表
		 * @return array
		 */
		$res = [];
		$tmp = [];

		if ( $request->input( 'list' ) == true ) {
			foreach ( $this->SignAll() as $item ) {
				in_array( $item['uid'], $res ) ?: $res[] = (string) $item['uid'];
				in_array( $item['name'], $res ) ?: $res[] = $item['name'];
			}

			sort( $res );

			return $res;
		}

		foreach ( $this->SignAll() as $item ) {
			array_key_exists( $item['uid'], $tmp ) ?: $tmp[ $item['uid'] ] = [];
			$tmp[ $item['uid'] ] = [ 'name' => $item['name'] ];
		}

		ksort( $tmp );

		foreach ( $tmp as $key => $value ) {
			$res[] = [
				'uid'  => $key,
				'name' => $value['name']
			];
		}

		return $res;

	}

	private function RewriteArray( $array ) {
		/*
		 * 修改为前端所需要的格式
		 * @param array $array
		 * @return array
		 */
		$newArray = [];
		foreach ( $array as $key => $value ) {
			$newArray[] = [ "key" => $key, "value" => $value ];
		}

		return $newArray;
	}

	private function SortMultiArray( $array, $key, $asc = false ) {
		/*
		 * 排序多维数组
		 * @param array $array
		 * @param string $key
		 * @param bool $asc
		 * @return array
		 */
		if ( count( $array ) == 0 ) {
			return $array;
		}

		if ( $asc == false ) {
			for ( $i = 0; $i < count( $array ); $i ++ ) {
				for ( $j = 0; $j < count( $array ) - 1; $j ++ ) {
					if ( $array[ $j + 1 ][ $key ] < $array[ $j ][ $key ] ) {
						$tmp             = $array[ $j + 1 ];
						$array[ $j + 1 ] = $array[ $j ];
						$array[ $j ]     = $tmp;
					}
				}
			}
		} else {
			for ( $i = 0; $i < count( $array ); $i ++ ) {
				for ( $j = 0; $j < count( $array ) - 1; $j ++ ) {
					if ( $array[ $j + 1 ][ $key ] > $array[ $j ][ $key ] ) {
						$tmp             = $array[ $j + 1 ];
						$array[ $j + 1 ] = $array[ $j ];
						$array[ $j ]     = $tmp;
					}
				}
			}
		}

		return $array;
	}
}