<?php namespace App\FromSky\Providers;


use DB;
use Event;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use App\FromSky\Composer\ViewShareSettingComposer;

/*
|--------------------------------------------------------------------------
| common fromSky service providers
|--------------------------------------------------------------------------
| here  will'be set all the common action
*/

class FromSkyCmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        |  SHARE VARIABLES TO VIEWS
        |--------------------------------------------------------------------------
        */

        /**
         *  Share  view name
         */
        view()->composer('*', function ($view) {
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });


        /*
         * share site_setting to fe views
         */
        view()->composer(['website/*', 'components/*'], ViewShareSettingComposer::class);


        /*
        |--------------------------------------------------------------------------
        |  LARACMS VALIDATION CUSTOM DIRECTIVE
        |--------------------------------------------------------------------------
        */
        Validator::extend('is_unique', function ($attribute, $value, $parameters, $validator) {
            $model  = request()->segment(3);
            $config = config('fromSky.admin.list.section.' . $model);
            $id     = (request()->segment(4)) ?: null;
            if (getModelFromString($config['model'])::where($attribute, $value)->where('id', '!=', $id)->count()) return false;
            return true;
        });

        Validator::extend(
            'recaptcha',
            'App\\FromSky\\Rules\\GoogleRecaptcha@passes'
        );

        Validator::extend(
            'field_locale',
            'App\\FromSky\\Rules\\FieldLocale@passes'
        );

        /*
        |--------------------------------------------------------------------------
        |  BLADE CUSTOM DIRECTIVE
        |--------------------------------------------------------------------------
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ViewShareSettingComposer::class);
    }
}
