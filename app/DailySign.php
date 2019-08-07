<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailySign extends Model
{
    protected $fillable = [
        'userid',
        'name',
        'platform',
        'date',
        'time',
        'rank'
    ];
}
