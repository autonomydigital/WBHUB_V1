<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (glob(base_path('Modules/*'), GLOB_ONLYDIR) as $modulePath) {
            $moduleName = basename($modulePath);
            $serviceProvider = "Modules\\{$moduleName}\\{$moduleName}ServiceProvider";

            if (class_exists($serviceProvider)) {
                $this->app->register($serviceProvider);
            }
        }
    }
}