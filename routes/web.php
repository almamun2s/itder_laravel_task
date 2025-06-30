<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('add/{product}', 'add_to_cart')->name('add');
        Route::post('/add_to_cart', 'store_to_cart')->name('store_to_cart');
        Route::post('/add_qty', 'add_qty')->name('add_qty');
        Route::post('/sub_qty', 'sub_qty')->name('sub_qty');
        Route::get('/remove_from_cart/{rowId}', 'remove_from_cart')->name('remove_from_cart');
        Route::get('/checkout', 'checkout')->name('checkout');
    });
});

require __DIR__ . '/auth.php';

// All routes for admin panel are here
require __DIR__ . '/admin.php';
