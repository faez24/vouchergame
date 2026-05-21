<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/topup/mobile-legends', function () {
    return view('topupgame.topupml');
})->name('topup.ml');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');
