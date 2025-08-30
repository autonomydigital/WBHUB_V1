<?php

namespace Modules\WebsiteContent;

use Illuminate\Support\ServiceProvider;

class WebsiteContentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/Resources/views', 'websitecontent');
    }

    public function register(): void
    {
        //
    }
}