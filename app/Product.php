<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id', 'product_name','product_dct','product_price','product_quantity','product_quantity_alert', 'product_image'];

    function categoryRelation() {
      return $this->hasOne('App\Category' ,'id', 'category_id');
    }
}
