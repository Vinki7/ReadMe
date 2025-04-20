<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/home');
});

Route::resource('/home', HomeController::class);

Route::resource('/products', ProductController::class);
