<?php
/**
 * Author: kamino
 * CreateTime: 2019/4/14,下午 05:00
 * Description:
 * Version:
 */

namespace App\Transformers;

use Dingo\Api\Http\Response\Format\Format;

class RawFormatter extends Format {
	function formatEloquentModel( $model ) {
		// TODO: Implement formatEloquentModel() method.
	}

	function formatEloquentCollection( $collection ) {
		// TODO: Implement formatEloquentCollection() method.
	}

	function formatArray( $content ) {
		// TODO: Implement formatArray() method.
	}

	function getContentType() {
		return 'image/jpeg';
	}
}