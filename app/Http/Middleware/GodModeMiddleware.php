<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class GodModeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Check if Nyrix is enabled in config
        if (!Config::get('nyrix.enabled')) {
            abort(403, 'Nyrix is currently disabled.');
        }

        // 2. Optionally check role for access to God Mode tools
        if (!$request->user() || !$request->user()->hasAnyRole(['god', 'superadmin'])) {
            abort(403, 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}