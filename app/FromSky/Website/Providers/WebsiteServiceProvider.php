<?php

namespace App\FromSky\Website\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class WebsiteServiceProvider extends ServiceProvider
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
        App::bind('HtmlHelper', function () {
            return new \App\FromSky\Tools\HtmlHelper;
        });
        App::bind('StoreHelper', function () {
            return new \App\FromSky\DomainLayer\Store\StoreHelper;
        });
        App::bind('ImgHelper', function () {
            return new \App\FromSky\Tools\ImgHelper;
        });
        App::bind('SeoLandingHelper', function () {
            return new \App\FromSky\SeoTools\SeoLandingHelper;
        });
        App::bind('FromSkyFeatures', function () {
            return new \App\FromSky\Tools\Features;
        });
    }
}
