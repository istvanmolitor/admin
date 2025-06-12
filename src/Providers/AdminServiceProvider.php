<?php

namespace Molitor\Admin\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AdminServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/js/components' => resource_path('js/components/molitor/admin'),
        ], 'admin');
    }

    public function register()
    {
    }
}
