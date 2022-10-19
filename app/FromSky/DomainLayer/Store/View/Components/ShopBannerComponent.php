<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use App\Model\Page;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\Model\Widget;
use Illuminate\View\View;
use Illuminate\Support\Collection;

use App\Model\ShipmentMethod;

/**
 * Class ShopBannerComponent
 * @package App\FromSky\DomainLayer\Store\View\Components
 */
class ShopBannerComponent extends CartBaseStepComponent
{
    /**
     *  CMS SLUG PAGE FOR SHOP_BANNER
     *  CONTENT
     */
    const SHOP_BANNER_SLUG = "shop-banner";
    public $banner;

    public function __construct()
    {
        $this->banner = Widget::firstWhere('code', self::SHOP_BANNER_SLUG);
    }

    public function render(): View
    {
        return view('fromsky_store::cart.shop_banner');;
    }

    public function show()
    {

        return ($this->banner->is_active && StoreFeatures::hasShopBanner());
    }

}
