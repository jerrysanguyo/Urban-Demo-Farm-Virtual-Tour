<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('login', LoginController::class)->only(['index']);
Route::post('/login/check', [LoginController::class, 'login'])->name('login.check');