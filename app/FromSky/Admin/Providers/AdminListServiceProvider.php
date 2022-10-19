<?php

namespace App\FromSky\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class AdminListServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('AdminList', function () {
            return new \App\FromSky\Admin\AdminList;
        });
        App::bind('AdminDecorator', function () {
            return new \App\FromSky\Admin\Decorators\AdminDecorator();
        });
    }
}
