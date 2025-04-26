<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBasket extends Model
{
    protected $fillable=['product_id','restaurant_id','count','user_id'];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class)->first();
    }

    public function product(){
        return $this->belongsTo(Product::class)->first();
    }
}


