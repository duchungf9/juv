<?php
/**
 * Created by PhpStorm.
 * User: web01
 * Date: 03/02/17
 * Time: 15:37
 */

namespace App\FromSky\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use App\FromSky\Tools\JsonResponseTrait;
use Auth;

class SetLocaleAdmin
{
    // use JsonResponseTrait;

    /**
     * Localization constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        config(['adminPage'=>true]);
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        if ($user) {
            $this->app->setLocale($user->locale);
        } else {
            $this->app->setLocale('vi');
        }
        // get the response after the request is done
        $response = $next($request);

        // return the response
        return $response;
    }
}
