<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin(){
       
        return view('admin.panel');
    }

    public function categoryList(){
        return view('admin.category-list');
    }
    public function productList(){
        return view('admin.product-list');
    }
    public function restaurantList(){
        return view('admin.restaurant-list');
    }

    public function home(){
        return view('front.index');
    }
}
