<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExworkController;

Route::get('/', function () {
    return view('index');
});

Route::get('/efeng', function () {
    return view('efeng.index');
});

Route::get('/efeng/exwork', [ExworkController::class, 'index']);

Route::get('/about',function () {
    return view('about');
});
