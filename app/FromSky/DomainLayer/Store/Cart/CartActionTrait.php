<?php


namespace App\FromSky\DomainLayer\Store\Cart;

/*
|--------------------------------------------------------------------------
|  Action
|--------------------------------------------------------------------------
*/

use App\FromSky\DomainLayer\Store\Action\ShippingCostResolverAction;

trait CartActionTrait
{


    function update_cart_address($address_field, $address_id)
    {
        $this->update([$address_field => $address_id]);
    }


    function calculate_shipping_cost()
    {
        return (new ShippingCostResolverAction($this))->execute();
    }

    function add_shipping_method($shipping_method_id)
    {
        $this->update(['shipping_method_id' => $shipping_method_id]);
        return $this;
    }

    function add_payment_method($payment_method_id)
    {
        $this->update(['payment_method_id' => $payment_method_id]);
        return $this;

    }

    function add_payment_and_shipment($data)
    {
        $this
            ->add_payment_method(data_get($data, 'payment_method_id'))
            ->add_shipping_method(data_get($data, 'shipping_method_id', null));
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    |  Status Action
    |--------------------------------------------------------------------------
    */
    /****
     * Update cart status
     * @param $status
     * @return $this
     */
    function set_status($status)
    {
        return $this->update(['status' => $status]);
        return $this;
    }

    /**
     * Mark Cart as abandoned / inactive
     * @return \App\Model\Cart|CartActionTrait
     */
    function markAsDisabled()
    {
        return $this->set_status(CART_DISABLED);;
    }

    /**
     * Mark Cart as sent whe order is created
     * @return \App\Model\Cart|CartActionTrait
     */
    function markAsSent()
    {
        return $this->set_status(CART_SENT);;
    }
}