<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class product_cat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'cat_parent', 'status',
    ];
    function product()
    {
        return $this->belongsTo('App\product');
    }
}
