<?php

namespace Molitor\Admin\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request)
    {
        return view('admin::admin');
    }
}
