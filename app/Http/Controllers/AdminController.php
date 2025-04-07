<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Category;


class AdminController extends Controller
{
    public function admin(){
       
        return view('admin.panel');
    }

    public function categoryList(){
        $categories=Category::all();
        return view('admin.category-list',['categories'=>$categories]);
    }
    public function productList(){
        $products=Product::all();
        return view('admin.product-list',['products'=>$products]);
    }
    public function restaurantList(){
        $restaurants=Restaurant::all();
        return view('admin.restaurant-list',['restaurants'=>$restaurants]);
    }
    public function restaurantCreate(){
        return view('admin.restaurant-create');
    }
    public function restaurantInsert(Request $request){

        $name=$request->input('name');
        $address=$request->input('address');
        $image=$request->input('image');
        
        Restaurant::create([
            'title'=>$name,
            'address'=>$address,
            'image'=>$image
        ]);
        return redirect(route('restaurant-list'));
    }

    public function categoryCreate(){
        return view('admin.category-create');
    }

    public function categoryInsert(Request $request){
        $name=$request->input('name');
        $description=$request->input('description');

         
        Category::create([
            'name'=>$name,
            'description'=>$description
        ]);
        return redirect(route('category-list'));

    }

    public function productCreate(){
        $categories=Category::all();
        $restaurants=Restaurant::all();
        return view('admin.product-create',[
            'categories'=>$categories,
            'restaurants'=>$restaurants
        ]);
    }

    public function productInsert(Request $request){
        $name=$request->input('name');
        $price=$request->input('price');
        $category_id=$request->input('category');
        $restaurant_id=$request->input('restaurant');

         
        Product::create([
            'name'=>$name,
            'price'=>$price,
            'category_id'=>$category_id,
            'restaurant_id'=>$restaurant_id
            
        ]);
        return redirect(route('product-list'));

    }

    

}
