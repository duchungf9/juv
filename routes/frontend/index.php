<?php

/*
|--------------------------------------------------------------------------
| FRONT END API
|--------------------------------------------------------------------------
 */

use App\FromSky\Website\Controllers\APIController;
use App\FromSky\Website\Controllers\Auth\ForgotPasswordController;
use App\FromSky\Website\Controllers\Auth\LoginController;
use App\FromSky\Website\Controllers\Auth\RegisterController;
use App\FromSky\Website\Controllers\Auth\ResetPasswordController;
use App\FromSky\Website\Controllers\ContactController;
use App\FromSky\Website\Controllers\FaqController;
use App\FromSky\Website\Controllers\NewsController;
use App\FromSky\Website\Controllers\PagesController;
use App\FromSky\Website\Controllers\ProductsController;
use App\FromSky\Website\Controllers\WebsiteFormController;
use App\FromSky\Website\Controllers\IcoController;
use App\Model\News;
use App\Model\Page;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| FRONT END
|--------------------------------------------------------------------------
 */
Route::group(['middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'usercart','cache.headers:public;max_age=2592000;etag']], function () {
    // Api
    Route::post('/api/newsletter', [APIController::class, 'subscribeNewsletter']);
    Route::get("/ico", [IcoController::class, 'routerList']);
    Route::get("/{slug}.icodrops", [IcoController::class, 'routerDetail']);
    // Authentication routes...
    Route::get('users/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('users/login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // Reserved area user routes
    Route::group(['middleware' => ['auth']], function () {
        Route::prefix('users')->group(base_path('routes/frontend/reserved_area.php'));
    });

    // Registration routes...
    /*Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [RegisterController::class, 'register']);*/

    // Password Reset Routes...
    /*Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);*/

    // Pages routes...
    Route::get('/', [PagesController::class, 'home'])->name('home');

    /*Route::prefix('news')->group(function () {
    });*/

    /*
    |--------------------------------------------------------------------------
    | FAQS
    |--------------------------------------------------------------------------
     */
    Route::prefix('faq')->group(function () {
        Route::get('/', [FaqController::class, 'index']);
        Route::get('/{slug}', [FaqController::class, 'index']);
    });

    /*
     *
     |---------------------------------------------------------
     *           view count
     |---------------------------------------------------------
     */

    Route::prefix('visitor')->group(function () {


        Route::post('log', [APIController::class, 'dispatchVisisterLog']);
    });



    /*
    |--------------------------------------------------------------------------
    | PRODUCTS
    |--------------------------------------------------------------------------
     */
//    Route::get(LaravelLocalization::transRoute("routes.category"), [NewsController::class, 'category'])->name('shop.index');
//    Route::get(LaravelLocalization::transRoute("routes.products"), [ProductsController::class, 'products']);

    Route::get(LaravelLocalization::transRoute('routes.contacts'), ContactController::class);
    Route::post('/contacts/', [WebsiteFormController::class, 'getContactUsForm']);

    // store page
    //Route::group(['as'=>'store.'],base_path('routes/frontend/store.php'));

    // store social_auth
    Route::group(['as' => 'social_auth.'], base_path('routes/frontend/social_auth.php'));

    /*
   |--------------------------------------------------------------------------
   | NEWS
   |--------------------------------------------------------------------------
   */
    // Search api
    Route::post('/searchkw', [WebsiteFormController::class, 'routerSearch']);
//    Route::get("/{inputKw}.find" , [WebsiteFormController::class, 'routerGetSearch'])->name('news.find');
    //news
    Route::get('{newsUri}/{newsUri1?}.{ext}', [NewsController::class, 'newShow'])->where('ext', 'html')->name('news.show');
    Route::get('{newsUri}/{newsUri1?}/{newsUri2?}.{ext}', [NewsController::class, 'newShow'])->where('ext', 'html')->name('news1.show');
    Route::get('{newsUri}/{newsUri1?}/{newsUri2?}/{newsUri3?}.{ext}', [NewsController::class, 'newShow'])->where('ext', 'html')->name('news2.show');


    //cat
    Route::get('{catUri}', [NewsController::class, 'category'])->name('news.category.index');
    Route::get('{catUri}/{catUri1?}', [NewsController::class, 'category'])->name('news.category1.index');
    Route::get('{catUri}/{catUri1?}/{catUri2?}', [NewsController::class, 'category'])->name('news.category2.index');
    Route::get('{catUri}/{catUri1?}/{catUri2?}/{catUri3?}', [NewsController::class, 'category'])->name('news.category3.index');

    //Route::get('{slug}', [NewsController::class, 'news']);

    Route::get('/{parent}/{child}', [PagesController::class, 'pages']);
    Route::get('/{parent?}/', [PagesController::class, 'pages']);
});
