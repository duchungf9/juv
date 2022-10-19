<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use Illuminate\View\View;
use Illuminate\Support\Collection;

use App\Model\ShipmentMethod;

/**
 * Class ShippingMethodComponent
 * @package App\FromSky\DomainLayer\Store\View\Components
 */
class ShippingCostComponent extends CartBaseStepComponent
{
    public $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function render(): View
    {
        return view('fromsky_store::cart.shipping_method');;
    }

    public function shipping_methods(): Collection
    {
        return ShipmentMethod::listed()->get();
    }
}
