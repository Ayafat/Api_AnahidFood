<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LogoutController;




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/restaurants/{id}',[HomeController::class,'restaurant'])->name('restaurant');
Route::get('/category/{id}',[HomeController::class,'category'])->name('category');
Route::get('/searchlist',[HomeController::class,'search'])->name('searchlist');

Route::post('/basket/add',[BasketController::class,'addbasket'])->name('basket.add');
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::get('/basket/edit/{id}',[BasketController::class,'editbasket'])->name('basket.edit');
Route::post('/basket/update',[BasketController::class,'updatebasket'])->name('basket.update');
Route::get('/basket/delete/{id}',[BasketController::class,'deletebasket'])->name('basket.delete');

Route::post('/checkout/{user_id}',[BasketController::class,'checkout'])->name('basket.checkout');

Route::get('/search',[HomeController::class,'search'])->name('search');
Route::get('/category/{id}',[HomeController::class,'category'])->name('category');

Route::middleware(['auth','roleAdmin'])->group(function (){
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
});

Route::get('/logout',[LogoutController::class,'logout'])->name('logout');

