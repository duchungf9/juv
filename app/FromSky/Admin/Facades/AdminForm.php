<?php

namespace App\FromSky\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class AdminForm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AdminForm';
    }
}