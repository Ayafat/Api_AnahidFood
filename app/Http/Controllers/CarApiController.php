<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarApiController extends Controller
{
   public function index()
    {
        dd(Auth::user()->id);
        $cars = Car::all();
        return response()->json([
            'status' => 'success',
            'data' => $cars
        ], 200);
    }
}
