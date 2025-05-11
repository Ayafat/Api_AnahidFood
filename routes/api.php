<?php

use App\Http\Controllers\CarApiController;
use App\Http\Controllers\userApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [userApiController::class, 'register']);
Route::get('cars', [CarApiController::class, 'index'])->middleware('auth:sanctum');
Route::post('login', [UserApiController::class, 'login']);


