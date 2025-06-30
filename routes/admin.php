<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', CheckAdmin::class])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});