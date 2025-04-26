<?php

namespace App\Http\Controllers;

use App\Models\ProductBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function addbasket($product_id,$restaurant_id){
        ProductBasket::create([
            'product_id'=>$product_id,
            'restaurant_id'=>$restaurant_id,
            'count'=>1,
            'user_id'=>Auth::user()->id

            
        ]);
        return redirect()->back();
    }
}
