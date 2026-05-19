<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/topup/mobile-legends', function () {
    return view('topupgame.topupml');
})->name('topup.ml');
