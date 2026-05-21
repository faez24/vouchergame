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

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/voucher', function () {
    return view('voucher');
})->name('voucher');

Route::get('/games', function () {
    return view('games');
})->name('games');
