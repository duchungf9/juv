<?php


namespace App\FromSky\DomainLayer\Store\Action;


class UpdateCartAddressAction
{


    private $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    function execute($request)
    {
        $shipping_address = (new AddAddressToCartAction($this->cart))->handle($request);
        $this->cart->update_cart_address('shipping_address_id', $shipping_address->id);
        if ($request->has('shippingAsBilling')) {
            $billing_address = (new AddAddressToCartAction($this->cart))->handle($request, 'billing');
            $this->cart->update_cart_address('billing_address_id', $billing_address->id);
        } else $this->cart->update_cart_address('billing_address_id', null);
    }
}