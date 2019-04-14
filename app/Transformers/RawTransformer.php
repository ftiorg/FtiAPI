<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract as Transformer;


class RawTransformer extends Transformer {
	public function transform( $response ) {

		return [ $response ];
	}
}