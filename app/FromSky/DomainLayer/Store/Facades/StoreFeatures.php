<?php

namespace App\FromSky\DomainLayer\Store\Facades;

use Illuminate\Support\Facades\Facade;

class StoreFeatures extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'StoreFeatures';
    }
}