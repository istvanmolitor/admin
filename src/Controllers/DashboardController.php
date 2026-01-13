<?php

namespace Molitor\Admin\Controllers;

use Illuminate\Http\Request;

class DashboardController
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request)
    {
        return inertia('Admin/Dashboard');
    }
}

