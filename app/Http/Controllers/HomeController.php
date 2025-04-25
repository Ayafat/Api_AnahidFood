<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    
    public function home(){

        $restaurants=Restaurant::paginate(4);
        $newrestaurants=Restaurant::orderByDesc('created_at')->limit(2)->get();
        $toprestaurants=Restaurant::orderByDesc('counter')->limit(4)->get();
        $sliderRestaurants=Restaurant::where('slide','=',1)->orderByDesc('updated_at')->limit(4)->get();
        $categories=Category::all();
        $usercount=User::all()->count();

        return view('front.index',[
            'restaurants'=>$restaurants,
            'newrestaurants'=>$newrestaurants,
            'categories'=>$categories,
            'usercount'=>$usercount,
            'toprestaurants'=>$toprestaurants,
            'sliderRestaurants'=>$sliderRestaurants
        ]);
        
    }

    public function restaurant($id,Request $request){
        $restaurant=Restaurant::findOrFail($id);
        $categories=Category::all();
        if($request->get('category')){
            $products=Product::where('restaurant_id','=',$restaurant->id)->where('category_id','=',$request->get('category'))->get();
        }else{
            $products=Product::where('restaurant_id','=',$restaurant->id)->get();
        }
        
        Restaurant::findOrFail($id)-> 
        update(['counter'=>$restaurant->counter + 1]);
       
        
        return view('front.restaurant',[
         'restaurant'=>$restaurant,
        'products'=>$products,
        'categories'=>$categories
     ]);
 
         }

         public function search(Request $request){
            $q=$request->get('q');
            $restaurants=Restaurant::where('title','like','%'.$q.'%')->get();
            return view('front.search',['restaurants'=>$restaurants]);
           
         }

         public function category($id){
            $category=Category::findOrFail($id);
            $products=Product::where('category_id','=',$category->id)->get();
            
            return view('front.category',[
             'category'=>$category,
            'products'=>$products
         ]);
     
             }  

}