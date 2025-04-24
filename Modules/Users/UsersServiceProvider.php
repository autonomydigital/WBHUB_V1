<?php

namespace Modules\Users;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class UsersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'users');
        $this->mergeConfigFrom(__DIR__.'/Config/config.php', 'users');
    }

    public function register()
    {
        //
    }
}
