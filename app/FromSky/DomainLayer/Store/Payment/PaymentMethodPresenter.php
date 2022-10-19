<?php


namespace App\FromSky\DomainLayer\Store\Payment;


trait PaymentMethodPresenter
{
    function hasFee()
    {
        return ($this->fee) ?? false;
    }
}