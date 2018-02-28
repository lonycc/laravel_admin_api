<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        /* 记录数据库操作日志 */
        /*
        \DB::listen(function ($query) {
            //\Log::info($query->sql);
            //\Log::info($query->bindings);
            //\Log::info($query->time);
        });
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
