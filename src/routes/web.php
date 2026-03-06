<?php

use Illuminate\Support\Facades\Route;
use Molitor\Admin\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/

Route::middleware(config('admin.middleware', ['web']))
    ->prefix(config('admin.prefix', 'admin'))
    ->group(function () {
        Route::get('/{any?}', [DashboardController::class, 'index'])->where('any', '.*')->name('admin.dashboard');
    });

