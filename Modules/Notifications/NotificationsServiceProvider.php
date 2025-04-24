<?php

namespace Modules\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'notifications');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    public function register() {}
}