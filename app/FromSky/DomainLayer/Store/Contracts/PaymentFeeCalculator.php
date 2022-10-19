<?php


namespace App\FromSky\DomainLayer\Store\Contracts;


use App\Model\PaymentMethod;

interface PaymentFeeCalculator
{
    function __construct(PaymentMethod $payment_method);

    function process();
}