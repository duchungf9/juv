<?php

namespace App\FromSky\DomainLayer\Store;

class Features
{

    /**
     * Determine if the given feature is enabled.
     *
     * @param string $feature
     * @return bool
     */
    public static function enabled(string $feature)
    {
        return in_array($feature, config('fromSky.store.features', []));
    }

    /**
     * Determine if the feature is enabled and has a given option enabled.
     *
     * @param string $feature
     * @param string $option
     * @return bool
     */
    public static function optionEnabled(string $feature, string $option)
    {
        return static::enabled($feature) &&
            config("fromSky.store.{$feature}.{$option}") === true;
    }

    /**
     * Determine if the store is enabled.
     *
     */
    public static function isStoreEnabled()
    {
        return config("fromSky.store.enabled") === true;
    }

    /**
     * Determine if shop as free shipping for all products.
     *
     */
    public static function hasFreeShipping()
    {
        return config("fromSky.store.shipping.enabled");
    }

    /**
     * Determine if product price can be displayed.
     *
     */
    public static function showPrice()
    {
        if (!self::isStoreEnabled()) return false;
        //price are only for  authenticated user
        if (config('fromSky.store.private_prices') && !auth_user()) return false;
        return true;
    }

    /**
     * Determine if shop show discount / promotion banner.
     *
     */
    public static function hasShopBanner()
    {
        return static::enabled(static::shopBanner());
    }

    public static function shopBanner()
    {
        return 'shop_banner';
    }
}