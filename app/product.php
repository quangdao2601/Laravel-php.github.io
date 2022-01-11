<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{   
    use SoftDeletes;
    protected $fillable = [
        'name', 'price', 'desc', 'content', 'qty', 'img_product', 'status', 'product_cat_id','old_price'
    ];
    function cat()
    {
        return $this->hasOne('App\product_cat');
    }
}
