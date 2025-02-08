<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('login', LoginController::class)->only(['index']);
Route::post('/login/check', [LoginController::class, 'login'])->name('login.check');

Route::middleware(['auth', 'check.user.role'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function() 
{
    Route::resource('type', TypeController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('item', ItemController::class);
});

Route::get('/item/show/{item}', [ItemController::class, 'show'])->name('item.show');
Route::get('/qr-scanner', [DashboardController::class, 'qrScanner'])->name('qr-scanner');