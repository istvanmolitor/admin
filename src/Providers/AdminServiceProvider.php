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

        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__ . '/../../resources/js/components' => resource_path('js/components/vendor/admin'),
        ], 'admin-components');
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
    }
}

