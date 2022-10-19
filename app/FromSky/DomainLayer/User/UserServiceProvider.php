<?php

namespace App\FromSky\DomainLayer\User;
;


use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;


/**
 *
 */
class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        App::bind('UserFeatures', function () {
            return new \App\FromSky\DomainLayer\User\UserFeatures;
        });

    }
}