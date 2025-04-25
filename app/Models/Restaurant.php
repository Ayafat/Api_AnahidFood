<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable= ['title','address','image','counter','slide'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
