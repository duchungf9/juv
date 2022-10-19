<?php


use App\FromSky\Admin\Controllers\AjaxImageCropperController;
use App\FromSky\Admin\Controllers\AjaxMediaListController;
use App\FromSky\Admin\Controllers\AjaxUploadifiveController;
use App\FromSky\Admin\Controllers\AjaxUploadifiveMediaController;
use App\FromSky\Admin\Controllers\AjaxUploadMediaTinyMCE;
use App\FromSky\Api\V1\Controllers\AdminFileMangerController;
use App\FromSky\Middleware\AdminSuggestRole;
use App\FromSky\Admin\Controllers\AjaxController;
use App\FromSky\Api\V1\Controllers\AdminCrudController;
use App\FromSky\Api\V1\Controllers\AdminServicesController;
use App\FromSky\Admin\Controllers\SuggestAjaxController;

Route::group([], function () {

    /*
     * CACHE CONTROLL
     */

    Route::prefix("cache")->group(function(){
        Route::post("remove-cache" , [AjaxController::class, "routerClearCache"]);
    });


    /*
    |--------------------------------------------------------------------------
    | MEDIA LIBRARY
    |--------------------------------------------------------------------------
    */
    Route::post('uploadifiveSingle/', [AjaxUploadifiveController::class, 'handle']);
    Route::post('uploadifiveMedia/', [AjaxUploadifiveMediaController::class,'handle']);
    Route::post('cropperMedia/', [AjaxImageCropperController::class,'handle']);
    Route::get('updateHtml/media/{model?}', [AjaxMediaListController::class, 'updateModelMediaList']);
    Route::get('updateHtml/{mediaType?}/{model?}/{id?}', [AjaxMediaListController::class, 'updateMediaList']);
    Route::get('updateMediaSortList/', [AjaxMediaListController::class, 'updateMediaSortList']);
    Route::post('upload-media-tinymce/', [AjaxUploadMediaTinyMCE::class, 'handle']);

    /*
    |--------------------------------------------------------------------------
    | API LIBRARY
    |--------------------------------------------------------------------------
    */

    Route::get('api/suggest', ['as' => 'api.suggest', 'uses' => [SuggestAjaxController::class,'suggest']])->middleware(AdminSuggestRole::class);
    Route::get('dashboard', [AdminServicesController::class,'dashboard']);
    Route::get('sections', [AdminServicesController::class,'sections']);
    Route::get('nav-bar', [AdminServicesController::class,'navbar']);

    /*
    |--------------------------------------------------------------------------
    | API FILE MANAGER
    |--------------------------------------------------------------------------
    */

    Route::prefix('file-manager')->group(function () {
        Route::get('grid/{id?}', [AdminFileMangerController::class,'index']);
        Route::get('edit/{id}',  [AdminFileMangerController::class,'edit']);
        Route::post('edit/{id}', [AdminFileMangerController::class,'update']);
        Route::get('delete/{id}', [AdminFileMangerController::class,'deleteMedia']);
    });

    Route::post('filemanager/upload', [AjaxController::class, 'uploadFileManager']);
    /*
    |--------------------------------------------------------------------------
    | API SERVICES LIBRARY
    |--------------------------------------------------------------------------
    */

    Route::post('services/generator', [AdminServicesController::class,'generator']);

    /*
    |--------------------------------------------------------------------------
    | CRUD LIBRARY
    |--------------------------------------------------------------------------
    */
    Route::post('create/{model}', [AdminCrudController::class,'create']);
    Route::post('update/{model}/{id}', [AdminCrudController::class,'update']);
    Route::get('update/{method}/{model?}/{id?}', [AjaxController::class, 'update']);
    Route::get('delete/{model?}/{id?}', [AjaxController::class, 'delete']);

});
