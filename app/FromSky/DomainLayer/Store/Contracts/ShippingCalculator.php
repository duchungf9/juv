<?php


namespace App\FromSky\DomainLayer\Store\Contracts;


use App\Model\Cart;

interface ShippingCalculator
{

    function getAmount();

    function getCost(Cart $cart);
}