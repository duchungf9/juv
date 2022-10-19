<?php


namespace App\FromSky\DomainLayer\Store\Action;


use App\FromSky\DomainLayer\Store\Shipping\CustomShippingCostCalculator;
use App\FromSky\DomainLayer\Store\Shipping\ShippingCalculatorInterface;
use App\FromSky\DomainLayer\Store\Shipping\StandardShippingCostCalculator;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;

class ShippingCostResolverAction
{
    /**
     * @var Cart
     */
    private $cart;


    public function __construct($cart)
    {
        $this->cart = $cart;

    }

    function execute()
    {
        if (config('fromSky.store.shipping.use_service')) {
            //TODO add your shipping cost calculator here
            (new ShippingCostAction(new CustomShippingCostCalculator, $this->cart))->execute();
        }
        return (new ShippingCostAction(new StandardShippingCostCalculator, $this->cart))->execute();
    }

}