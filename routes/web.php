<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Pail\ValueObjects\Origin\Console;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('home', HomeController::class);

Route::post('/update-screen-size', function (Request $request) {
    session(["screenSize" => $request->input('screen_width')]);
    return response()->json(['success' => true]);
});
