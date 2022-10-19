<?php

namespace App\FromSky\DomainLayer\Project;

use App\FromSky\SeoTools\SeoPermalinkResolver;
use App\FromSky\Website\Facades\ImgHelper;
use Mcamara\LaravelLocalization\LaravelLocalization;

trait ProjectPresenter

{
    /*
    |--------------------------------------------------------------------------
    |  Seo & Meta
    |--------------------------------------------------------------------------
    */
    use SeoPermalinkResolver;

    public function getThumbImage()
    {
        return ImgHelper::get_cached($this->image, config('fromSky.image.small'));
    }
}
