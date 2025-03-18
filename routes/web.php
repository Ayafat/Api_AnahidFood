<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/',[HomeController::class,'home']);
Route::get('/admin',[HomeController::class,'admin']);
Route::get('/admin/category/list',[HomeController::class,'categoryList'])->name('category-list');
Route::get('/admin/product/list',[HomeController::class,'productList'])->name('product-list');
Route::get('/admin/restaurant/list',[HomeController::class,'restaurantList'])->name('restaurant-list');