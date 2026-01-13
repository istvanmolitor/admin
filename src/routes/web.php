<?php

use Illuminate\Support\Facades\Route;
use Molitor\Admin\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/

Route::middleware(config('admin.middleware', ['web', 'auth']))
    ->prefix(config('admin.prefix', 'admin'))
    ->group(function () {
        // Dashboard route
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

