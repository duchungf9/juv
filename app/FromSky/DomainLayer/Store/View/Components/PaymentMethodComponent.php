<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use Illuminate\View\View;
use Illuminate\Support\Collection;


use App\Model\PaymentMethod;

/**
 * Class PaymentMethodComponent
 * @package App\FromSky\DomainLayer\Store\View\Components
 */
class PaymentMethodComponent extends CartBaseStepComponent
{

    public function render(): View
    {
        return view('fromsky_store::cart.payment_method');;
    }

    public function payment_methods(): Collection
    {
        return PaymentMethod::listed()->get();
    }
}
