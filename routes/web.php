<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SubDescriptionController;

Route::get('/', function () {
    if(Auth::check())
    {
        return redirect()
            ->route(Auth::user()->role . '.dashboard');
    }
    return redirect('login');
});

Route::get('/login', function () {
    if (Auth::check()) 
    {
        return redirect()
            ->route(Auth::user()->role . '.dashboard');
    }
    return view('auth.login');
})->name('login.index');

Route::post('/login/check', [LoginController::class, 'login'])
    ->name('login.check');
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/home', [DashboardController::class, 'home'])
    ->name('home');

Route::middleware(['auth', 'check.user.role'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {
        Route::get('/storage-link', [DashboardController::class, 'storageLink'])
            ->name('storage.link');
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
        Route::post('/item/sub-description/store/{itemDetail}/{item}', [ItemController::class, 'subDescriptionStore'])
            ->name('subDescription.store');
        Route::get('/item/sub-description/edit/{subDescription}/{itemDetail}', [ItemController::class, 'subDescriptionEdit'])
            ->name('subDescription.edit');
        Route::put('/item/sub-description/update/{subDescription}/{itemDetail}/{item}', [ItemController::class, 'subDescriptionUpdate'])
            ->name('subDescription.update');
        Route::delete('/item/sub-description/destroy/{subDescription}/{itemDetail}/{item}', [ItemController::class, 'subDescriptionDestroy'])
            ->name('subDescription.destroy');
        Route::get('/item/qr/{item}', [ItemController::class, 'showQr'])
            ->name('item.qr');
    });

Route::get('/item/show/{item}', [ItemController::class, 'show'])
    ->name('item.show');
Route::get('/qr-scanner', [DashboardController::class, 'qrScanner'])
    ->name('qr-scanner');