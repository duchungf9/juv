<?php

namespace App\FromSky\DomainLayer\Store\Cart;


use App\FromSky\DomainLayer\Store\Facades\StoreHelper;

class CartVieModel
{
    public $cart;
    public $items;

    function __construct()
    {
        $this->cart  = StoreHelper::getSessionCart();
        $this->items = StoreHelper::getCartItems();
    }


    function isEmpty()
    {
        return $this->items->isEmpty();
    }
}