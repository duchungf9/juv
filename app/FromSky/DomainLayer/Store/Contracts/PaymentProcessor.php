<?php


namespace App\FromSky\DomainLayer\Store\Contracts;


use App\Model\Cart;

interface PaymentProcessor
{
    function __construct(Cart $cart);

    function process();

}