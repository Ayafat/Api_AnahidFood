<?php

use App\Http\Controllers\AdminCategoryApiController;
use App\Http\Controllers\AdminProductApiController;
use App\Http\Controllers\AdminRestaurantApiController;
use App\Http\Controllers\CarApiController;
use App\Http\Controllers\userApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::post('/register', [userApiController::class, 'register']);
Route::get('cars', [CarApiController::class, 'index'])->middleware('auth:sanctum');
Route::post('login', [UserApiController::class, 'login']);
Route::get('logout', [UserApiController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/admin/categories', [AdminCategoryApiController::class, 'index']);
Route::get('/admin/categories/{id}', [AdminCategoryApiController::class, 'show']);
Route::post('/admin/categories/create', [AdminCategoryApiController::class, 'create']);
Route::put('/admin/categories/update/{id}', [AdminCategoryApiController::class, 'update']);
Route::delete('/admin/categories/delete/{id}', [AdminCategoryApiController::class, 'delete']);

Route::get('/admin/restaurants', [AdminRestaurantApiController::class, 'index']);
Route::get('/admin/restaurants/{id}', [AdminRestaurantApiController::class, 'show']);
Route::post('/admin/restaurants/create', [AdminRestaurantApiController::class, 'create']);
Route::put('/admin/restaurants/update/{id}', [AdminRestaurantApiController::class, 'update']);
Route::delete('/admin/restaurants/delete/{id}', [AdminRestaurantApiController::class, 'delete']);

Route::get('/admin/products', [AdminProductApiController::class, 'index']);
Route::get('/admin/products/{id}', [AdminProductApiController::class, 'show']);
Route::post('/admin/products/create', [AdminProductApiController::class, 'create']);
Route::put('/admin/products/update/{id}', [AdminProductApiController::class, 'update']);
Route::delete('/admin/products/delete/{id}', [AdminProductApiController::class, 'delete']);