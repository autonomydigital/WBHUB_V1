<?php

namespace Modules\UserProfiles;

use Illuminate\Support\ServiceProvider;

class UserProfilesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //  Fix casing: should be "Routes" not "routes"
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        //  Optionally: Set up views with namespace (if needed)
        $this->loadViewsFrom(__DIR__.'/resources/views', 'UserProfiles');    }

    public function register()
    {
        //
    }
}