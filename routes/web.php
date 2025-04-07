<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/',[HomeController::class,'home']);
Route::get('/restaurants/{id}',[HomeController::class,'restaurant'])->name('restaurant');
Route::get('/admin',[AdminController::class,'admin']);
Route::get('/admin/category/list',[AdminController::class,'categoryList'])->name('category-list');
Route::get('/admin/product/list',[AdminController::class,'productList'])->name('product-list');
Route::get('/admin/restaurant/list',[AdminController::class,'restaurantList'])->name('restaurant-list');
Route::get('/admin/restaurant/create',[AdminController::class,'restaurantCreate'])->name('restaurant-create');
Route::post('/admin/restaurant/insert',[AdminController::class,'restaurantInsert'])->name('restaurant-insert');
Route::get('/admin/category/create',[AdminController::class,'categoryCreate'])->name('category-create');
Route::post('/admin/category/insert',[AdminController::class,'categoryInsert'])->name('category-insert');
Route::get('/admin/product/create',[AdminController::class,'productCreate'])->name('product-create');
Route::post('/admin/product/insert',[AdminController::class,'productInsert'])->name('product-insert');