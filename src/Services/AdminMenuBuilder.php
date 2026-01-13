<?php

declare(strict_types=1);

namespace Molitor\Admin\Services;

use Molitor\Menu\Services\Menu;
use Molitor\Menu\Services\MenuBuilder;

class AdminMenuBuilder extends MenuBuilder
{
    public function init(Menu $menu, string $name, array $params = []): void
    {
        if ($name !== 'admin') {
            return;
        }

        if (app()->routesAreCached() || count(app('router')->getRoutes()) > 0) {
            $menu->addItem('Dashboard', route('admin.dashboard'))
                ->setName('dashboard')
                ->setIcon('layout-grid');
        }
    }
}

