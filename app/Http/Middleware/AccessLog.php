<?php

namespace App\Http\Middleware;

use Closure;
use App\Log;
use Composer\DependencyResolver\Request;

class AccessLog {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		$r = Log::create( [
			'method' => \Request::getMethod(),
			'url'    => \Request::fullUrl(),
			'param'  => \Request::getMethod() == 'POST' ? json_encode( \Request::post() ) : null,
			'ip'     => \Request::getClientIp(),
			'user'   => null
		] );

		return $next( $request );
	}
}
