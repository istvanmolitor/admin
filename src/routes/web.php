<?php

use Illuminate\Support\Facades\Route;

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
        Route::get('/', function () {
            return inertia('Admin/Dashboard');
        })->name('admin.dashboard');
    });

