<?php

namespace App\FromSky\Notifications;

use Illuminate\Support\Facades\Facade;

class Flash extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flash';
    }
}