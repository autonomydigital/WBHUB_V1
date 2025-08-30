<?php

namespace Modules\Properties;

use Illuminate\Support\ServiceProvider;

class PropertiesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'properties');
    }

    public function register(): void
    {
        //
    }
}