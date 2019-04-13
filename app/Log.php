<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Log
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $method
 * @property string|null $url
 * @property string|null $param
 * @property string|null $ip
 * @property string|null $user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereIp( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereMethod( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereParam( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUrl( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUser( $value )
 */
class Log extends Model {
	protected $fillable = [
		'method',
		'url',
		'param',
		'ip',
		'user',
		'time'
	];
}
