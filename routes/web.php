<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect('/home');
});

Route::resource('/home', HomeController::class);

Route::resource('/products', ProductController::class);

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])
        ->name('index');
    Route::patch('/{productId}', [CartController::class, 'update'])
        ->name('update');
    Route::delete('/{productId}', [CartController::class, 'destroy'])
        ->name('destroy');
    Route::post('/add/{productId}', [CartController::class, 'addToCart'])
        ->name('add');
});
