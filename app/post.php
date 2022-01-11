<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{   
    use SoftDeletes;
    protected $fillable = [
        'title', 'descc', 'content',  'img_post', 'status', 'post_cat_id'
    ];
}
