<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordList extends Model {
	protected $connection = 'study';
	protected $table = 'wordlist-2017';
	protected $fillable = [
		'ID',
		'EN',
		'ZH'
	];
}
