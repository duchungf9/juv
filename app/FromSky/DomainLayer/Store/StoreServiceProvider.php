<?php

namespace App\FromSky\DomainLayer\Store;


use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

use App\FromSky\DomainLayer\Store\View\Components\ResumeComponent;
use App\FromSky\DomainLayer\Store\View\Components\ShippingCostLabel;
use App\FromSky\DomainLayer\Store\View\Components\CartProductsWidget;
use App\FromSky\DomainLayer\Store\View\Components\ShopBannerComponent;
use App\FromSky\DomainLayer\Store\View\Components\ProductDisplayPrice;
use App\FromSky\DomainLayer\Store\View\Components\PaymentFeeComponent;
use App\FromSky\DomainLayer\Store\View\Components\PaymentMethodComponent;
use App\FromSky\DomainLayer\Store\View\Components\ShippingMethodComponent;


use App\FromSky\DomainLayer\Store\View\Components\OrderListComponent;
use App\FromSky\DomainLayer\Store\View\Components\OrderPaymentComponent;
use App\FromSky\DomainLayer\Store\View\Components\OrderShippingComponent;

use App\FromSky\DomainLayer\Store\View\Components\AddressComponent;

/**
 * Class StoreServiceProvider
 * @package App\FromSky\DomainLayer\Store
 */
class StoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this
            ->registerBladeClasses()
            ->registerPublishables();
        //$this->mergeConfigFrom(__DIR__ . '/config/store.php', 'store');
        App::bind('StoreFeatures', function () {
            return new \App\FromSky\DomainLayer\Store\Features;
        });
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'fromsky_store');
        $this->loadViewComponentsAs('fromsky_store', [
            AddressComponent::class,
            CartProductsWidget::class,
            ResumeComponent::class,
            OrderPaymentComponent::class,
            OrderShippingComponent::class,
            OrderListComponent::class,
            ShippingMethodComponent::class,
            ShopBannerComponent::class,
            PaymentMethodComponent::class,
            PaymentFeeComponent::class,
            ProductDisplayPrice::class,
            ShippingCostLabel::class,

        ]);
        $this->publishes([
            __DIR__ . 'resources/views' => resource_path('views/vendor/fromsky_store'),
        ]);
    }

    protected function registerPublishables(): self
    {
        /* if ($this->app->runningInConsole()) {
             $this->publishes([
                 __DIR__ . '/config/store.php' => config_path('store.php'),
             ], 'config');

         }*/
        return $this;
    }


    protected function registerBladeClasses(): self
    {
        return $this;
    }
}