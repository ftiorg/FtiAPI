<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transformers\UserTransformer;

class UserController extends Controller {
	public function index() {
		$users = User::all();

		return $this->response->collection( $users, new UserTransformer );
	}

	public function show( $id ) {
		$user = User::findOrFail( $id );

		return $this->response->item( $user, new UserTransformer );
	}
}
