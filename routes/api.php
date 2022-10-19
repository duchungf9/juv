<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\FromSky\Api\V1\Controllers\NewsController;
use App\FromSky\Api\V1\Controllers\UserController;
use App\FromSky\Api\V1\Controllers\PagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('page', [PagesController::class, 'index']);
    Route::get('page/{id}', [PagesController::class, 'show']);
    Route::get('news', [NewsController::class, 'index']);
    Route::get('news/{slug}', [NewsController::class, 'show']);
    Route::post('user', [UserController::class, 'create']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


