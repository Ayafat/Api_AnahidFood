<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/',[HomeController::class,'home']);
Route::get('/restaurants/{id}',[HomeController::class,'restaurant'])->name('restaurant');
Route::get('/admin',[AdminController::class,'admin']);
Route::get('/admin/category/list',[AdminController::class,'categoryList'])->name('category-list');
Route::get('/admin/category/create',[AdminController::class,'categoryCreate'])->name('category-create');
Route::post('/admin/category/insert',[AdminController::class,'categoryInsert'])->name('category-insert');
Route::get('/admin/category/edit/{id}',[AdminController::class,'categoryEdit'])->name('category-edit');
Route::post('/admin/category/update',[AdminController::class,'categoryUpdate'])->name('category-update');
Route::get('/admin/category/delete/{id}',[AdminController::class,'categoryDelete'])->name('category-delete');

Route::get('/admin/product/list',[AdminController::class,'productList'])->name('product-list');
Route::get('/admin/product/create',[AdminController::class,'productCreate'])->name('product-create');
Route::post('/admin/product/insert',[AdminController::class,'productInsert'])->name('product-insert');
Route::get('/admin/product/edit/{id}',[AdminController::class,'productEdit'])->name('product-edit');
Route::post('/admin/product/update',[AdminController::class,'productUpdate'])->name('product-update');
Route::get('/admin/product/delete/{id}',[AdminController::class,'productDelete'])->name('product-delete');


Route::get('/admin/restaurant/list',[AdminController::class,'restaurantList'])->name('restaurant-list');
Route::get('/admin/restaurant/create',[AdminController::class,'restaurantCreate'])->name('restaurant-create');
Route::post('/admin/restaurant/insert',[AdminController::class,'restaurantInsert'])->name('restaurant-insert');
Route::get('/admin/restaurant/edit/{id}',[AdminController::class,'restaurantEdit'])->name('restaurant-edit');
Route::post('/admin/restaurant/update',[AdminController::class,'restaurantUpdate'])->name('restaurant-update');
Route::get('/admin/restaurant/delete/{id}',[AdminController::class,'restaurantDelete'])->name('restaurant-delete');