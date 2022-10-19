<?php

namespace App\FromSky\Middleware;

use Closure;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use Illuminate\Support\Facades\Redirect;

class StoreEnabled
{
    public function __construct()
    {
    }

    public function handle($request, Closure $next)
    {
        if (StoreFeatures::isStoreEnabled())
            return $next($request);
        else
            return Redirect::to('/');
    }
}
