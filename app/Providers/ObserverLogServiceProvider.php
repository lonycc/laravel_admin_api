<?php

namespace App\Providers;

use App\Models\AdminUser;
use App\Observers\UserObserver;

use Illuminate\Support\ServiceProvider;

class ObserverLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        AdminUser::observe(UserObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
