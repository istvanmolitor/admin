<?php

namespace Molitor\Admin\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request)
    {
        return inertia('Admin/User/Dashboard');
    }
}
