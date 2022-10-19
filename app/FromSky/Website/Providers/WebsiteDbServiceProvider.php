<?php

namespace App\FromSky\Website\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class WebsiteDbServiceProvider extends ServiceProvider
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
        App::bind('App\FromSky\Website\Repos\Page\PageRepositoryInterface', 'App\FromSky\Website\Repos\Page\DbPageRepository');
        App::bind('App\FromSky\Website\Repos\News\NewsRepositoryInterface', 'App\FromSky\Website\Repos\News\DbNewsRepository');
        App::bind('App\FromSky\Website\Repos\Product\ProductRepositoryInterface', 'App\FromSky\Website\Repos\Product\DbProductRepository');
        App::bind('App\FromSky\Website\Repos\Category\CategoryRepositoryInterface', 'App\FromSky\Website\Repos\Category\DbCategoryRepository');

    }
}
