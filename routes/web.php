<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleAuthController;
use Inertia\Inertia;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VocaBisnisCallbackController;
use App\Http\Controllers\WelcomeController;

Route::get('/', WelcomeController::class);

Route::get('/topup/mobile-legends', [TopupController::class, 'show'])
    ->defaults('productId', 15)
    ->name('topup.ml');

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('login');

Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
Route::get('/auth-google-callback', [GoogleAuthController::class, 'callback']);

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return back();
})->name('logout');

Route::get('/cart', function () {
    return Inertia::render('Cart');
})->name('cart');

Route::get('/checkout', function () {
    return Inertia::render('Checkout');
})->name('checkout');

Route::get('/voucher', function () {
    return Inertia::render('Voucher');
})->name('voucher');

Route::get('/games', \App\Http\Controllers\GamesController::class)->name('games');

Route::get('/topup/{productId}', [TopupController::class, 'show'])->name('topup.show');
Route::post('/topup/{productId}/checkout', [TopupController::class, 'store'])->name('topup.checkout');
Route::get('/transaction/{invoiceId}', [TransactionController::class, 'show'])->name('transaction.show');
Route::post('/callback/vocabisnis', VocaBisnisCallbackController::class)->name('vocabisnis.callback');
