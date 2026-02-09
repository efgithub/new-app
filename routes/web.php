<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // 用於 dashboard 顯示使用者名稱
use App\Http\Controllers\ExworkController;
use App\Http\Controllers\LoginController; // ★ 記得要引用這個，不然會報錯

/*
|--------------------------------------------------------------------------
| 1. 公開區 (Guest)
|--------------------------------------------------------------------------
| 只有「未登入」的人可以訪問。
| 如果已經登入的人嘗試訪問這裡，會自動跳轉回首頁或 Dashboard。
*/
Route::middleware('guest')->group(function () {
    // 首頁 (現在被保護了，沒登入進不來)
    Route::get('/', function () {
        return view('index');
    });
// 顯示登入頁
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    // 送出登入資料
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

/*
|--------------------------------------------------------------------------
| 2. 保護區 (Auth)
|--------------------------------------------------------------------------
| 只有「已登入」的人可以訪問。
| 沒登入的人點這些連結，會被強制踢回 /login。
*/
Route::middleware('auth')->group(function () {


    // 儀表板
    Route::get('/dashboard', function () {
        return '<h1>登入成功！</h1> <p>歡迎回來，' . Auth::user()->username . '</p>
                <form action="/logout" method="POST"><input type="hidden" name="_token" value="'.csrf_token().'"><button type="submit">登出</button></form>';
    });

    // Efeng 相關路由
    Route::get('/efeng', function () {
        return view('efeng.index');
    });

    Route::get('/efeng/exwork', [ExworkController::class, 'index']);

    // ★ 登出功能 (務必加上，不然進得去出不來)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
// 關於我們
    Route::get('/about', function () {
        return view('about');
    });

