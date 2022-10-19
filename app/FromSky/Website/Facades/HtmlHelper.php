<?php
/**
 * Created by PhpStorm.
 * User: n0impossible
 * Date: 6/14/15
 * Time: 1:47 PM
 */

namespace App\FromSky\Website\Facades;

use Illuminate\Support\Facades\Facade;

class HtmlHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'HtmlHelper';
    }

    public static function getUrl($model){
        $modelName = (!is_object($model)) ? strtolower($model) : strtolower(class_basename($model));
        return URL::to( '/' . $modelName . '/' . $model->id);
    }
}
