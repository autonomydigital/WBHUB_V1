<?php

namespace Modules\Businesses;

use Illuminate\Support\ServiceProvider;

class BusinessesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'businesses');
    }

    public function register(): void
    {
        //
    }
}