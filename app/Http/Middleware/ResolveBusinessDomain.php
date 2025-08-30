<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Business;

class ResolveBusinessDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();
    
        $business = Business::where('custom_domain', $host)->first();
    
        if ($business) {
            // Share business globally
            app()->instance('currentBusiness', $business);
            view()->share('currentBusiness', $business);
        }
    
        return $next($request);
    }
}
