<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable= ['name','price','category_id','restaurant_id']; 

    public function category(){
        return $this->belongsTo(Category::class)->first();
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class)->first();
    }

    public function productBaskets()
    {
        return $this->hasMany(ProductBasket::class);
    }
}
