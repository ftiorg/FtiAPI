<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BliveDanmu extends Model
{
	protected $connection = 'study';
	protected $table = 'danmu';
	protected $fillable = [
		'id',
		'uid',
		'name',
		'msg',
		'time'
	];
}
