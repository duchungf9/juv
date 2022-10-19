<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(request()->is('admin/*')){
            Paginator::useBootstrap();
        }else{
            Paginator::defaultView('vendor.pagination.tailwind');
            Paginator::defaultSimpleView('vendor.pagination.simple-tailwind');
        }

        app()->setLocale("vi");
        //
    }
}
