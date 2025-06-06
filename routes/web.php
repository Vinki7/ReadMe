<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;


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

Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/address', [CheckoutController::class, 'address'])
        ->name('address');
    Route::post('/address', [CheckoutController::class, 'handleRequest'])
        ->name('address.submit');
    Route::get('/payment', [CheckoutController::class, 'payment'])
        ->name('payment');
    Route::post('/payment', [CheckoutController::class, 'processPayment'])
        ->name('payment.submit');
});

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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('listing');
    Route::resource('products', AdminController::class)->except(['create', 'store', 'show']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('listing');
    Route::get('/product/{product}/edit', [AdminController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}', [AdminController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [AdminController::class, 'destroy'])->name('product.destroy');
    Route::delete('/product/{product}/images/{type}', [AdminController::class, 'deleteImage'])
        ->where('type', 'front_cover|back_cover|book_insights|full_book')
        ->name('product.image.delete');
    Route::get('/product/create', [AdminController::class, 'createProduct'])->name('product.create');
    Route::get('/author/create', [AdminController::class, 'createAuthor'])->name('author.create');
    Route::post('/product', [AdminController::class, 'storeProduct'])->name('product.store');
    Route::post('/author', [AdminController::class, 'storeAuthor'])->name('author.store');
});
