<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the admin panel settings for your application.
    |
    */

    'name' => env('ADMIN_NAME', 'Admin Panel'),

    'prefix' => env('ADMIN_PREFIX', 'admin'),

    'middleware' => ['web', 'auth'],

    'route_namespace' => 'Molitor\\Admin\\Http\\Controllers',

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    'dashboard' => [
        'enabled' => true,
        'route' => 'dashboard',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Menu
    |--------------------------------------------------------------------------
    */

    'menu' => [
        'items' => [
            // Add your menu items here
        ],
    ],
];

