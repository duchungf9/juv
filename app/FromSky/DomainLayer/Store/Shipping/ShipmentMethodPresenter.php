<?php

namespace App\FromSky\DomainLayer\Store\Shipping;

use App\FromSky\DomainLayer\Store\Facades\StoreHelper;

trait ShipmentMethodPresenter
{

    function getCartLabelAttribute()
    {

        if ($this->fee == 0) return $this->title . ' - ' . __('store.shipping.free');
        if ($this->free_shipping_from == 0) return $this->title . ' - ' . StoreHelper::formatPrice($this->fee);
        return $this->title . ' - ' . StoreHelper::formatPrice($this->fee) . ' - ' . __('store.shipping.free_from', ['amount' => StoreHelper::formatPrice($this->free_shipping_from)]);
    }
}
