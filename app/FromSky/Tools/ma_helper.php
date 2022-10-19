<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Model\Page;

use App\FromSky\Tools\Tool;
use App\FromSky\Tools\HtmlHelper;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use Jenssegers\Agent\Agent;

/*
|--------------------------------------------------------------------------
|  LOCALIZATION  AND PERMALINK
|--------------------------------------------------------------------------
*/

function get_locale()
{
    return LaravelLocalization::getCurrentLocale();
}

function url_locale($url)
{
    return LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), URL::to($url));
}

// This function return the route slug url
function route_url_locale($slug)
{
    return url_locale(trans('routes.' . $slug));
}

function page_permalink_by_id($page_id, $locale = '')
{
    return Page::getPermalinkById($page_id, $locale);
}


function getNameSnake($str)
{
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
}

/*
|--------------------------------------------------------------------------
|   PATH HELPERS / SHORTCUTS
|--------------------------------------------------------------------------
*/

/*******************     DOC    *****************/
function ma_get_doc_path_from_repository($doc)
{
    $path = config('fromSky.admin.path.doc_repository');
    return public_path($path . $doc);
}

function ma_get_doc_from_repository($doc)
{
    $path = config('fromSky.admin.path.doc_repository');
    return asset($path . $doc);
}

/*******************      IMAGES      *****************/

/**
 * @param      $img
 * @param bool $absolute
 * @return string
 */
function ma_get_image_path_from_repository($img, $absolute = true)
{
    $path = config('fromSky.admin.path.img_repository');
    if (file_exists($path . $img)) {
        return ($absolute == true) ? asset($path . $img) : $path . $img;
    } else {
        return ($absolute == true) ? asset($path . 'placeholder.png') : $path . 'placeholder.png';
    }
}

/**
 * @param      $img
 * @param bool $absolute
 * @return string
 */
function ma_get_image_from_repository($img, $folder = '', $absolute = true)
{

    $imgPath = ($folder) ? $folder . "/" . $img : $img;
    return ma_get_image_path_from_repository($imgPath, $absolute);
}

/**
 * ritorna l'immagine solo se presente
 * nel file system
 *
 * @param      $img
 * @param bool $absolute
 * @return string
 */
function ma_get_image_from_repository_if_exists($img, $absolute = true)
{
    return ($img != '') ? ma_get_image_path_from_repository($img, $absolute) : "";
}

/**
 *
 * generate img on the  fly
 * @param        $asset
 * @param        $w
 * @param        $h
 * @param string $type
 * @return null|string
 */
function ma_get_image_on_the_fly($asset, $w, $h, $type = 'jpg')
{
    if ($asset != '') {
        $img = Image::make(ma_get_image_from_repository($asset, false))->fit($w, $h)->encode($type);
        return 'data:image/' . $type . ';base64,' . base64_encode($img);
    } else {
        return null;
    }
}

/**
 * get img  on  the  fly cached
 * @param        $asset
 * @param        $w
 * @param        $h
 * @param string $type
 * @param int    $fit
 * @return string
 */
function ma_get_image_on_the_fly_cached($asset, $w, $h, $type = 'jpg', $fit = 1)
{
    if (file_exists(ma_get_image_path_from_repository($asset))) {
        $dataImage          = array();
        $dataImage['asset'] = $asset;

        $dataImage['w']    = $w;
        $dataImage['h']    = $h;
        $dataImage['type'] = $type;
        $dataImage['fit']  = $fit;
        $img               = Image::cache(function ($image) use ($dataImage) {
            $image->make(ma_get_image_from_repository($dataImage['asset'], false));

            if ($dataImage['fit'] == 1) {
                $image->resize($dataImage['w'], $dataImage['h']);
            } else {
                $image->fit($dataImage['w'], $dataImage['h']);
            }

            $image->encode($dataImage['type']);
        });
        return 'data:image/' . $type . ';base64,' . base64_encode($img);
    } else {
        return ma_get_image_path_from_repository($asset);
    }
}

/**
 * Is the mime type an image
 */
function is_image($mimeType)
{
    return Str::startsWith($mimeType, 'image/');
}

/*******************     USER UPLOAD    *****************/
function ma_get_upload_from_repository($doc)
{
    $path = config('fromSky.admin.path.user_upload');
    return asset($path . $doc);
}

/*
|--------------------------------------------------------------------------
|    PATH HELPERS/SHORTCUTS FOR ADMIN SECTION
|--------------------------------------------------------------------------
*/
function ma_get_admin_list_url($model)
{
    $path      = config('cms.admin_path').'/list';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName);//Str::plural($modelName)
}

function ma_get_admin_create_url($model)
{
    $path      = config('cms.admin_path').'/create';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName);//Str::plural($modelName)
}

function ma_get_admin_edit_url($model)
{
    $path      = config('cms.admin_path').'/edit';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName . '/' . $model->id);//$modelName
}

function ma_get_admin_view_url($model)
{
    $path      = config('cms.admin_path').'/view';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName . '/' . $model->id);
}

function ma_get_admin_editmodal_url($model)
{
    $path      = config('cms.admin_path').'/editmodal';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName . '/' . $model->id);
}

function ma_get_admin_delete_url($model)
{
    $path      = config('cms.admin_path').'/delete';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName . '/' . $model->id);
}

function ma_get_admin_impersonated_url($model)
{
    $path      = config('cms.admin_path').'/impersonated';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName . '/' . $model->id);
}

function ma_get_admin_preview_url($model)
{
    $modelName    = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    $resourcePath = ($modelName != 'page') ? $modelName . '/' . $model->slug : $model->slug;
    $path         = LaravelLocalization::getLocalizedURL(App::getLocale(), URL::to($resourcePath));
    if (is_object($model) && method_exists($model, 'getPermalink')) {
        return URL::to($model->getPermalink());
    }
    return URL::to($path);
}

function ma_get_admin_copy_url($model)
{
    $path      = config('cms.admin_path').'/duplicate';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName . '/' . $model->id);
}

function ma_get_admin_export_url($model)
{
    $path      = config('cms.admin_path').'/exportlist';
    $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
    return URL::to($path . '/' . $modelName);
}

if (!function_exists('flash')) {
    function flash($message = null)
    {
        $notifier = app('flash');
        if (!is_null($message)) {
            return $notifier->info($message);
        }
        return $notifier;
    }
}

/*
|--------------------------------------------------------------------------
|   String  & Sanitizer
|--------------------------------------------------------------------------
*/
function sanitizeParameter($parameter)
{
    return htmlspecialchars($parameter, ENT_QUOTES, 'utf-8');
}

function ma_sluggy($stringa, $separator = '-', $locale = '')
{
    $locale = ($locale) ?: app()->getLocale();
    if ($locale == 'zh') {
        return $stringa;
    }
    return Slugify::slugify($stringa, $separator);
}

/**
 * @param string $summary
 * @param int    $length
 */
function strLimit(string $summary, int $length = 100): \Illuminate\Support\Stringable
{
    return Str::of($summary)->limit($length);
}

/*
|--------------------------------------------------------------------------
|  PATH Localization
|--------------------------------------------------------------------------
*/
function ma_get_file_from_storage($file, $disk = '', $folder = '')
{
    if ($disk) {
        $storage = Storage::disk($disk);
    } else {
        $storage = Storage::disk('media');
    }
    if ($folder) {
        $image = asset($storage->url($folder . '/' . $file));
    } else {
        $image = asset($storage->url('images/' . $file));
    }

    return $image;
}


/*
|--------------------------------------------------------------------------
|  STORE
|--------------------------------------------------------------------------
*/
function store_currency()
{
    return config('fromSky.store.currency_symbol');
}

function store_enabled___()
{
    return StoreFeatures::isStoreEnabled();
}


/*
|--------------------------------------------------------------------------
|  HELPERS
|--------------------------------------------------------------------------
*/

// icons
function icon($icons, $classes = '', $force_set = '', $echo = true)
{
    return Htmlhelper::createFAIcon($icons, $classes, $force_set, $echo);
}

// development
function loremImage($width = 800, $height = 800)
{
    return 'https://picsum.photos/id/' . rand(0, 1000) . '/' . $width . '/' . $height;
}


function generate_password()
{
    return Tool::generatePassword();
}

/**
 * This method is used to pull a model out of the ioc container given its name as string.
 *
 * @param        $string
 * @param string $namespace
 *
 * @return \Illuminate\Foundation\Application|mixed
 */
function getModelFromString($string, $namespace = "\\App\\Model\\")
{
    return app($namespace . ucfirst($string));
}

if (!function_exists('mobileDt')) {
    /**
     * Undocumented function
     *
     * @return Jenssegers\Agent\Agent
     * @noinspection ProperNullCoalescingOperatorUsageInspection
     */
    function mobileDt()
    {
        if (($_ENV['mobileDt'] ?? false) === false) {
            $_ENV['mobileDt'] = new Agent();
        }
        return $_ENV['mobileDt'];
    }
}
/**
 * Get data from cache with all time config
 * @param      $key
 * @param      $callback
 * @param null $time
 * @return mixed
 * @throws Exception
 */
function reGet($key, $callback, $time = null): mixed
{
    $key = $key . md5(request()->fullUrl());
    if (is_null($time)) {
        $time = now()->addMinutes(config('cms.time_cache'));
    }
    return Cache::tags(['website'])->remember($key, $time, $callback);
}

/**
 * Flush website cache for clean cache
 */
function reFlushWebsite()
{
    Artisan::call('httpcache:clear');
    return Cache::tags(['website'])->flush();
}

/**
 * @param         $key
 * @param         $callback
 * @param null    $time
 * @return mixed
 */
function reGetAdmin($key, $callback, $time = null): mixed
{
    $user = auth()->guard("admin")->user();
    if (!is_null($user)) {
        $key .= $user->email;
    }
    $key .= md5(request()->fullUrl());
    if (is_null($time)) {
        $time = now()->addMinutes(config('cms.time_cache'));
    }
    return Cache::tags(['admin'])->remember($key, $time, $callback);
}

/**
 * Flush admin cache for clean cache
 */
function reFlushAdmin()
{
    return Cache::tags(['admin'])->flush();
}

/**
 * @param        $key
 * @param string $default
 * @return mixed|string|null
 */
function nullReturn($key, string $default = ''): mixed
{
    return is_null($key) ? $key : $default;
}


function getUserEditCreate($model)
{
    $userAll          = \App\Model\AdminUser::all();
    $userCreatedEmail = '- - -';
    $userUpdatedEmail = '- - -';
    foreach ($userAll as $user) {
        if ($user->id == $model->created_by) {
            $userCreatedEmail = $user->first_name . ' ' . $user->last_name . " (" . $user->email . ")";
        }
        if ($user->id == $model->updated_by) {
            $userUpdatedEmail = $user->first_name . ' ' . $user->last_name . " (" . $user->email . ")";
        }
    }

    $ct    = Carbon::create($model->created_at);
    $ut    = Carbon::create($model->updated_at);
    $now   = Carbon::now();
    $ctStr = $ct->diffForHumans($now);
    $utStr = $ut->diffForHumans($now);
    return "
        <div>Created {$ctStr} by {$userCreatedEmail}</div>
        <div>Updated {$utStr} by {$userUpdatedEmail}</div>
    ";
}

function detectSocialNameByUrl($url){
    $result = null;
    foreach(["facebook"=>"facebook","t.me"=>"telegram","twitter"=>"twitter","git"=>"github","linkedin"=>"linkedin"] as $key=> $item){
        if(Str::contains($url, $key)){
            $result = $item;
        }
    }

    return $result;

}