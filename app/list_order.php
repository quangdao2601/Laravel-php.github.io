<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class list_order extends Model
{
    protected $fillable=[
        'id_customer','id_product','code','qty','total'
    ];
}
