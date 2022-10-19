<?php

namespace App\FromSky\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class AdminDecorator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AdminDecorator';
    }
}