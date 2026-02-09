<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 顯示表單
    public function showLoginForm()
    {
        return view('login'); // 對應 resources/views/login.blade.php
    }

    // 處理登入
    public function login(Request $request)
    {
        // 1. 驗證欄位
        $credentials = $request->validate([
            'username' => ['required'], // 這裡對應表單的 name="username"
            'password' => ['required'],
        ]);

        // 2. 嘗試登入 (Laravel 會自動比對資料庫)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // 3. 失敗回傳
        return back()->withErrors([
            'username' => '帳號或密碼錯誤',
        ]);
    }
    public function logout(\Illuminate\Http\Request $request)
    {
        // 1. 登出使用者
        Auth::logout();

        // 2. 讓目前的 Session 失效 (為了安全)
        $request->session()->invalidate();

        // 3. 重新產生 CSRF Token (為了安全)
        $request->session()->regenerateToken();

        // 4. 轉址回登入頁面
        return redirect('/login');
    }
}
