<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix("cache")->group(function () {
    Route::any("remove-cache", [\App\FromSky\Admin\Controllers\AjaxController::class, "routerClearCache"]);
});


Route::prefix(config('cms.admin_path'))->group(base_path('routes/admin/index.php'));

/*
|--------------------------------------------------------------------------
| FRONT END ROUTESS
|--------------------------------------------------------------------------
*/
//if(isset($_GET['debug'])){
//    dd(LaravelLocalization::setLocale());
//}
Route::prefix(LaravelLocalization::setLocale())->group(base_path('routes/frontend/index.php'));


/*
|--------------------------------------------------------------------------
| FALLBACK ROUTES
|--------------------------------------------------------------------------
*/

/*Route::fallback(function () {
    return redirect(url_locale('/'));
});*/

