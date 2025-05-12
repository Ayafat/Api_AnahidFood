<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'message' => 'ثبت‌نام با موفقیت انجام شد',
                'user' => $user,
                'token' => $token
            ], 201);
    
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request){
        $data=$request->validate([ 'email' => 'required|string|email',
        'password' => 'required|string|min:6']);
            
        $user=User::where('email','=',$data['email'])->first();

        if(!$user || !Hash::check($data['password'],$user->password)){
            return response(['status'=>"user not found",401]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response(['token'=>$token,200]);
    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return response(['Done',200]);
        
    }
}
