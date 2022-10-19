<?php


namespace App\FromSky\DomainLayer\Store\Controllers\Payment;


use App\Model\Cart;
use App\Model\Order;

use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Action\CreateOrderAction;
use App\FromSky\DomainLayer\Store\Contracts\PaymentProcessor;

class BankTransfer implements PaymentProcessor
{

    /**
     * @var Cart
     */
    private Cart $cart;

    function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    function process(): Order
    {
        $order = $this->createOrder();
        if ($order) {
            StoreHelper::createPayment($order->id, $this->cart->payment_method_id);
            return $order;
        }
        return false;
    }

    function createOrder()
    {
        return (new CreateOrderAction($this->cart))->execute();
    }
}