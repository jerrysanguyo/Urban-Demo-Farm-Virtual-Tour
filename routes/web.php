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
    ->group(function () {
        Route::resource('type', TypeController::class);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('item', ItemController::class);
        Route::post('/item/store/{item}', [ItemController::class, 'detailStore'])
            ->name('itemDetail.store');
        Route::get('/item/edit/{item}/{itemDetail}', [ItemController::class, 'detailEdit'])
            ->name('itemDetail.edit');
        Route::put('/item/update/{item}/{itemDetail}', [ItemController::class, 'detailUpdate'])
            ->name('itemDetail.update');
        Route::delete('/item/destroy/{item}/{itemDetail}', [ItemController::class, 'detailDestroy'])
            ->name('itemDetail.destroy');
    });

Route::get('/item/show/{item}', [ItemController::class, 'show'])->name('item.show');
Route::get('/qr-scanner', [DashboardController::class, 'qrScanner'])->name('qr-scanner');