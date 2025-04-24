<?php

// This is the Nyrix AI module bootstrap setup
// Directory: Modules/Nyrix

namespace Modules\Nyrix;

use Illuminate\Support\ServiceProvider;

class NyrixServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'Nyrix');
        
        // Optional config publishing
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/nyrix.php' => config_path('nyrix.php')
            ], 'config');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/nyrix.php', 'nyrix'
        );

        $this->app->singleton('nyrix.commander', function () {
            return new \Modules\Nyrix\Services\NyrixCommandDispatcher();
        });
    }

    
}
