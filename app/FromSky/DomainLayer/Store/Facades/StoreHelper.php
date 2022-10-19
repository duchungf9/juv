<?php

namespace App\FromSky\DomainLayer\Store\Facades;

use Illuminate\Support\Facades\Facade;

class StoreHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'StoreHelper';
    }
}
