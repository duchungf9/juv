<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use App\Model\PaymentMethod;
use Illuminate\View\View;


/**
 * Class PaymentFeeComponent
 * @package App\FromSky\DomainLayer\Store\View\Components
 */
class PaymentFeeComponent extends CartBaseStepComponent
{
    public $payment_method;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->payment_method = $paymentMethod;
    }

    public function render(): View
    {
        return view('fromsky_store::cart.payment_fee');
    }


}
