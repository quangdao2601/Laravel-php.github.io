<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class post_cat extends Model
{
   
    protected $fillable = [
        'name', 'cat_parent', 'status',
    ];
}
