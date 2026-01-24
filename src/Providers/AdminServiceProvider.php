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

        $this->registerPublishables();
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

    /**
     * Register publishable resources.
     */
    protected function registerPublishables(): void
    {
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');

        // Publish Vue components
        $this->publishes([
            __DIR__ . '/../../resources/js/components' => resource_path('js/components/admin'),
        ], 'admin-components');

        // Publish shadcn-vue UI components
        if (is_dir(__DIR__ . '/../../resources/js/components/ui')) {
            $this->publishes([
                __DIR__ . '/../../resources/js/components/ui' => resource_path('js/components/ui'),
            ], 'admin-ui');
        }

        // Publish TypeScript/JS utilities and composables
        if (is_dir(__DIR__ . '/../../resources/js/lib')) {
            $this->publishes([
                __DIR__ . '/../../resources/js/lib' => resource_path('js/lib'),
            ], 'admin-lib');
        }

        if (is_dir(__DIR__ . '/../../resources/js/composables')) {
            $this->publishes([
                __DIR__ . '/../../resources/js/composables' => resource_path('js/composables/admin'),
            ], 'admin-composables');
        }

        // Publish CSS/styles
        if (is_dir(__DIR__ . '/../../resources/css')) {
            $this->publishes([
                __DIR__ . '/../../resources/css' => resource_path('css/admin'),
            ], 'admin-styles');
        }

        // Publish views (if any)
        if (is_dir(__DIR__ . '/../../resources/views')) {
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/admin'),
            ], 'admin-views');
        }

        // Publish assets (public files)
        if (is_dir(__DIR__ . '/../../resources/public')) {
            $this->publishes([
                __DIR__ . '/../../resources/public' => public_path('vendor/admin'),
            ], 'admin-public');
        }

        // Publish all resources at once
        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
            __DIR__ . '/../../resources/js/components' => resource_path('js/components/admin'),
        ], 'admin-all');
    }
}

