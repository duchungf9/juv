<?php


namespace App\FromSky\DomainLayer\Store\Contracts;


use App\Model\Cart;

interface DiscountCalculator
{
    function __construct(Cart $cart);

    function process();
}