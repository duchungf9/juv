<?php


namespace App\FromSky\DomainLayer\Store\Payment;


use App\Model\Cart;

use App\FromSky\DomainLayer\Store\Contracts\PaymentFeeCalculator;
use App\Model\PaymentMethod;

class StandardPaymentFeeCalculator implements PaymentFeeCalculator
{


    private PaymentMethod $payment_method;

    public function __construct(PaymentMethod $payment_method)
    {

        $this->payment_method = $payment_method;
    }

    function process()
    {
        return $this->calculateAmount();
    }

    protected function calculateAmount()
    {
        return optional($this->payment_method)->fee ?? 0;
    }
}