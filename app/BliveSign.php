<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BliveSign
 *
 * @property int $id
 * @property int $uid
 * @property string $name
 * @property string $date
 * @property string $time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BliveSign whereUid($value)
 * @mixin \Eloquent
 */
class BliveSign extends Model {
	protected $connection = 'study';
	protected $table = 'sign';
	protected $fillable = [
		'id',
		'uid',
		'name',
		'date',
		'time'
	];
}
