<?php


namespace App\FromSky\DomainLayer\Store\Action;


use App\Model\Cart;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Contracts\ShippingCalculator;
use App\FromSky\DomainLayer\Store\Shipping\ShippingCalculatorInterface;

class ShippingCostAction
{
    /**
     * @var Cart
     */
    private Cart $cart;
    /**
     * @var ShippingCalculator
     */
    private ShippingCalculator $shippingCalculator;

    public function __construct(ShippingCalculator $shippingCalculator, $cart)
    {
        $this->cart               = $cart;
        $this->shippingCalculator = $shippingCalculator;
    }

    function execute()
    {
        $this->cart->shipping_cost = $this->calculate();
        $this->cart->save();
    }

    function calculate()
    {
        if (StoreHelper::isShippingEnabled()) return $this->shippingCalculator->getCost($this->cart);
        return 0;
    }
}