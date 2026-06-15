<?php

use Illuminate\Support\Facades\Route;
use Molitor\Admin\Http\Controllers\Api\SearchController;

Route::middleware(['api', 'auth:sanctum'])
    ->prefix('admin')
    ->group(function () {
        Route::get('search', SearchController::class)->name('admin.search');
    });
