<?php

namespace Molitor\Admin\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Molitor\Admin\Middleware\ShareAdminData;
use Molitor\Admin\Search\AdminSearchRegistry;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AdminSearchRegistry::class);

        // Merge admin configuration
        $this->mergeConfigFrom(
            __DIR__.'/../config/admin.php',
            'admin'
        );

        $this->publishes([
            __DIR__.'/../config/admin.php' => config_path('admin.php'),
            __DIR__.'/../../resources/js' => resource_path('vendor/admin/js'),
            __DIR__.'/../../resources/css' => resource_path('vendor/admin/css'),
            __DIR__.'/../../resources/js/pages/Admin' => resource_path('js/pages/Admin/User'),
        ], 'admin');

        $this->publishes([
            __DIR__.'/../../resources/js/pages/Admin' => resource_path('js/pages/Admin'),
        ], 'admin-pages');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->app->make(Router::class)
            ->group(['prefix' => 'api'], __DIR__.'/../routes/api.php');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        // Register middleware
        $this->app['router']->aliasMiddleware('admin.share', ShareAdminData::class);

        $registry = $this->app->make(AdminSearchRegistry::class);

        foreach (config('admin.search.searchers', []) as $class) {
            $registry->register($this->app->make($class));
        }
    }
}
