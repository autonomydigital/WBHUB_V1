<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Business; // Update if you're using a module namespace
use Illuminate\Support\Facades\Log;

class ValidateSubdomain
{
    public function handle(Request $request, Closure $next)
    {

        Log::info('🧪 ValidateSubdomain middleware triggered', [
            'host' => $request->getHost(),
            'full_url' => $request->fullUrl()
        ]);
        $host = $request->getHost(); // e.g. subdomain.wbhub.test
        $subdomain = explode('.', $host)[0];
    
        // Skip validation if it's the main domain or accessing /admin
        if (
            $subdomain === 'wbhub' ||
            str_starts_with($request->path(), 'admin') ||
            in_array($request->path(), ['login', 'register', 'logout', 'password/reset', 'password/email'])
        ) {
            return $next($request);
        }
    
        $business = \App\Models\Business::where('subdomain', $subdomain)->first();
    
        if (!$business) {
            return redirect()->away('http://wbhub.test/');
        }
    
        app()->instance('currentBusiness', $business);
    
        return $next($request);
    }
}