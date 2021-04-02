<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::name('admin.')->group(function() {
    Route::get('login', [Admin\LoginController::class, 'index'])->name('login');
    Route::post('login', [Admin\LoginController::class, 'authenticate'])->name('authenticate');

    Route::middleware('auth.admin')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [Admin\LoginController::class, 'logout'])->name('logout');
    });
});
