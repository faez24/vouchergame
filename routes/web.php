<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/topup/mobile-legends', function () {
    return view('topupgame.topupml');
})->name('topup.ml');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth-google-callback', [GoogleAuthController::class, 'callback']);

Route::get('/cart', function () {
    return view('cart');
})->name('cart');
