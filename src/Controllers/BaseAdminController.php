<?php

namespace Molitor\Admin\Controllers;

use App\Http\Controllers\Controller;
use Molitor\Menu\Facades\Menu;
use Molitor\Menu\Services\Menu as MenuService;

class BaseAdminController extends Controller
{
    protected function getAdminMenu(): MenuService
    {
        return Menu::build('admin');
    }
}
