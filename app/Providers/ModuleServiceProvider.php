<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $modulesPath = base_path('Modules');

        if (!File::exists($modulesPath)) {
            return;
        }

        $modules = File::directories($modulesPath);

        foreach ($modules as $modulePath) {
            $moduleName = basename($modulePath);
            $serviceProvider = "Modules\\{$moduleName}\\{$moduleName}ServiceProvider";

            if (class_exists($serviceProvider)) {
                $this->app->register($serviceProvider);
            } else {
                logger()->warning("⚠️ Module '$moduleName' not loaded: $serviceProvider not found.");
            }
        }
    }
}