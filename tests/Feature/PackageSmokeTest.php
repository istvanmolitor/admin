<?php

namespace Molitor\Admin\Tests\Feature;

use Molitor\Admin\Providers\AdminServiceProvider;
use Tests\TestCase;

class PackageSmokeTest extends TestCase
{
    public function test_service_provider_is_loaded(): void
    {
        $this->assertTrue(class_exists(AdminServiceProvider::class));
        $this->assertTrue($this->app->providerIsLoaded(AdminServiceProvider::class));
    }
}

