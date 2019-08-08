<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QqappOpenId extends Model
{
    protected $fillable = [
        'code',
        'openid',
        'key',
        'unionid'
    ];
}
