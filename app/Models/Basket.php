<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable= ['user_id','is_paid'];
    public function productBaskets()
    {
        return $this->hasMany(ProductBasket::class, 'basket_id');
    }

}
