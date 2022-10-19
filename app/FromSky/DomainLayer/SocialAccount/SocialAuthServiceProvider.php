<?php

namespace App\FromSky\DomainLayer\SocialAccount;


use Illuminate\Support\ServiceProvider;


use App\FromSky\DomainLayer\SocialAccount\View\Components\ButtonComponent;
use App\FromSky\DomainLayer\SocialAccount\View\Components\HeaderComponent;
use App\FromSky\DomainLayer\SocialAccount\View\Components\ItemsComponent;
use App\FromSky\DomainLayer\SocialAccount\View\Components\LoginComponent;

/**
 * Class StoreServiceProvider
 * @package App\FromSky\DomainLayer\Store
 */
class SocialAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerBladeClasses()
            ->registerPublishables();

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'fromsky_social');
        $this->loadViewComponentsAs('fromsky_social', [
            ItemsComponent::class,
            LoginComponent::class,
            HeaderComponent::class,
            ButtonComponent::class,

        ]);
        $this->publishes([
            __DIR__ . 'resources/views' => resource_path('views/vendor/fromsky_social'),
        ]);
    }

    protected function registerPublishables(): self
    {
        return $this;
    }


    protected function registerBladeClasses(): self
    {
        return $this;
    }
}