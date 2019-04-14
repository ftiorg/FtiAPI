<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract as Transformer;

/**
 * Class UserTransformer.
 */
class UserTransformer extends Transformer {
	public function transform( $response ) {
		return [
			$response
		];
	}
}
