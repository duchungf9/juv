<?php

namespace App\FromSky\DomainLayer\User\Facades;

use Illuminate\Support\Facades\Facade;

class UserFeatures extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserFeatures';
    }
}
