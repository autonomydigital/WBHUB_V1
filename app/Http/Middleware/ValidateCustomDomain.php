<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use App\Models\Business;

class ValidateCustomDomain
{
    public function handle($request, Closure $next)
    {
        $host = $request->getHost();

        // Ignore system subdomains like *.wbhub.test
        if (Str::endsWith($host, config('app.main_domain', 'wbhub.test'))) {
            return $next($request); // Let the subdomain middleware handle it
        }

        // Match against custom domains
        $business = Business::where('custom_domain', $host)->first();

        if (!$business) {
            abort(404, 'Business not found.');
        }

        // Share the business instance globally
        app()->instance('currentBusiness', $business);

        return $next($request);
    }
}