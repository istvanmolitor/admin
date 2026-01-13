<?php

namespace Molitor\Admin\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Molitor\Menu\Facades\Menu;
use Symfony\Component\HttpFoundation\Response;

class ShareAdminData
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        Inertia::share('menu', fn () => Auth::check() ? Menu::build('admin')->toArray() : []);

        Inertia::share('flash', fn () => [
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
            'info' => $request->session()->get('info'),
            'warning' => $request->session()->get('warning'),
        ]);

        return $next($request);
    }
}

