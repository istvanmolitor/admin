<?php

namespace Molitor\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Molitor\Admin\Middleware\ShareAdminData;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge admin configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/admin.php',
            'admin'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admin');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Register middleware
        $this->app['router']->aliasMiddleware('admin.share', ShareAdminData::class);

        // Publishing is only available when running in console
        if ($this->app->runningInConsole()) {
            // Publish configuration
            $this->publishes([
                __DIR__ . '/../config/admin.php' => config_path('admin.php'),
            ], 'admin-config');

            // Publish views
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/admin'),
            ], 'admin-views');

            // Publish assets
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/admin'),
            ], 'admin-assets');
        }
    }
}

