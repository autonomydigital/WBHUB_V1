<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        $this->configureRateLimiting();
    
        $this->routes(function () {
            // API Routes
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
                
            // 🟢 Subdomain-based websites
            Route::middleware(['web', 'validate.subdomain'])
                ->domain('{business}.wbhub.test')
                ->group(base_path('Modules/WebsiteContent/Routes/website-frontend.php'));

            // 🔶 Custom domain-based websites
            Route::middleware(['web', 'validate.customdomain'])
                ->group(base_path('Modules/WebsiteContent/Routes/website-frontend.php'));
    
            // Admin + fallback
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/fallback.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}