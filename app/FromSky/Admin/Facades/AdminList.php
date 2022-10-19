<?php

namespace App\FromSky\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class AdminList extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AdminList';
    }
}