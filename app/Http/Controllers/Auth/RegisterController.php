<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * تعیین مسیر هدایت بعد از ثبت‌نام
     */
    protected $redirectTo = '/login';

    /**
     * نمایش فرم ثبت‌نام
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * اعتبارسنجی داده‌های ثبت‌نام
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * ایجاد کاربر جدید
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * متد ثبت‌نام که پس از ارسال فرم اجرا می‌شود
     */
    public function register(Request $request)
    {
        // اعتبارسنجی داده‌های فرم
        $this->validator($request->all())->validate();

        // ایجاد کاربر جدید
        event(new Registered($user = $this->create($request->all())));

        // لاگین نکردن کاربر به‌صورت خودکار
        // $this->guard()->login($user);

        // هدایت کاربر به صفحه لاگین همراه با پیام موفقیت
        return redirect('/login')->with('success', 'ثبت‌نام شما با موفقیت انجام شد، لطفاً وارد شوید.');
    }
}
