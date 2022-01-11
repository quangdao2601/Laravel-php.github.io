<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'name', 'email', 'address','phone','note','payment','code','qty','total'
    ];
}
