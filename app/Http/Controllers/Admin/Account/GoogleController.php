<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        $user = Socialite::driver('google')->user();

        // Tìm hoặc tạo một bản ghi user mới trong bảng "users" của Laravel
        $userModel = User::where('email', $user->getEmail())->first();
        if (!$userModel) {
            $userModel = new User();
            $userModel->name = $user->getName();
            $userModel->email = $user->getEmail();
            $userModel->password = bcrypt('password'); // Mật khẩu tạm thời
            $userModel->save(); // Lưu user mới vào database
        }
    
        Auth::login($userModel);

        return redirect('/dashboard');
    }
}
