<?php

namespace App\FromSky\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use App;

use App\FromSky\Admin\AdminFormImageRelation;

class AdminFormServiceProvider extends ServiceProvider
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
        App::bind('AdminForm', function () {
            return new \App\FromSky\Admin\AdminForm;
        });

        App::bind('AdminFormImageRelation', function () {
            return new AdminFormImageRelation;
        });
    }
}
