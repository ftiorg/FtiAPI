<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BliveGift extends Model
{
	protected $connection = 'study';
	protected $table = 'gift';
	protected $fillable = [
		'id',
		'uid',
		'name',
		'gift',
		'num',
		'time'
	];
}
