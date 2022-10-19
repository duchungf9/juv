<?php

namespace App\FromSky\DomainLayer\Product;

use App\FromSky\Website\Facades\ImgHelper;
use App\FromSky\SeoTools\SeoPermalinkResolver;

trait ProductPresenter

{
    /*
    |--------------------------------------------------------------------------
    |  Seo & Meta
    |--------------------------------------------------------------------------
    */
    use SeoPermalinkResolver;

    public function getInfoPermalink()
    {
        return url_locale('/contacts/?product_id=' . $this->id);
    }

    public function getThumbImage()
    {
        return ImgHelper::init('products')->get_cached($this->image, config('fromSky.image.small'));
    }
}
