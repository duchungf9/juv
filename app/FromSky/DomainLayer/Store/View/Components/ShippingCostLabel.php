<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use Illuminate\View\View;
use Illuminate\Support\Collection;

use App\Model\ShipmentMethod;

/**
 * Class ShippingMethodComponent
 * @package App\FromSky\DomainLayer\Store\View\Components
 */
class ShippingCostLabel extends CartBaseStepComponent
{
    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;

    }

    public function render(): View
    {
        return view('fromsky_store::partials.shipping_cost');
    }
}


