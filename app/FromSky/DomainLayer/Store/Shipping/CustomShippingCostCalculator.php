<?php


namespace App\FromSky\DomainLayer\Store\Shipping;


use App\Model\Cart;
use App\FromSky\DomainLayer\Store\Contracts\ShippingCalculator;


class CustomShippingCostCalculator implements ShippingCalculator
{
    protected $cart;
    private $shipping_method;

    function getCost(Cart $cart): float
    {
        $this->cart = $cart;
        return $this->getAmount();
    }

    function getAmount(): float
    {
        $this->shipping_method = $this->cart->shipping_method;
        if ($this->isFree()) return 0;
        return $this->calculate($this->cart->getTotalProductsWithDiscount());
    }

    function isFree(): bool
    {
        return $this->shipping_method->fee == 0;

    }

    function calculate($product_total): float
    {

        if ($this->shipping_method->free_shipping_from < $product_total) return 0;
        return $this->shipping_method->fee;
    }
}