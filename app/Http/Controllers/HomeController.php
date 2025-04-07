<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
class HomeController extends Controller
{
    
    public function home(){

        $restaurants=Restaurant::all();

        return view('front.index',['restaurants'=>$restaurants]);
        
    }

    public function restaurant($id){
        $restaurant=Restaurant::findOrFail($id);
        $products=Product::where('restaurant_id','=',$restaurant->id)->get();
        return view('front.restaurant',[
            'restaurant'=>$restaurant,
            'products'=>$products
        ]);
    }
}
