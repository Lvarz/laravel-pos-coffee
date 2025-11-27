<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     * - Owners: allow all pages
     * - Employees: allow only POS pages (routes beginning with '/pos' or named 'pos.*')
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Owner can access everything
        if ($user->role === 'owner') {
            return $next($request);
        }

        // Employee: only allow POS routes
        $path = $request->path(); // e.g. 'pos' or 'pos/checkout'
        $routeName = optional($request->route())->getName();

        if (str_starts_with($path, 'pos') || ($routeName && str_starts_with($routeName, 'pos.'))) {
            return $next($request);
        }

        // Otherwise, deny access. Redirect employee to POS with error message.
        return redirect()->route('pos.index')->with('error', 'สิทธิ์ไม่เพียงพอในการเข้าถึงหน้านี้');
    }
}
