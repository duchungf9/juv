<?php


namespace App\FromSky\DomainLayer\Store\Cart;

use Illuminate\Session\Store;

use App\Model\Discount;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Discounts\CouponDiscountCalculator;
use App\FromSky\DomainLayer\Store\Payment\StandardPaymentFeeCalculator;

trait CartPresenter
{


    function isEmpty()
    {

        return $this->countItems < 1;
    }


    function hasBillingAddress()
    {

        return $this->billing_address_id > 0;
    }

    function getCountItemsAttribute()
    {

        return $this->cart_items()->count();
    }

    function getCartProductPrice()
    {
        return $this->cart_items()->count();
    }

    function addDiscount($code)
    {
        return $this->update(['discount_code' => $code]);
    }

    function removeDiscount()
    {
        return $this->update(['discount_code' => null]);
    }

    function getDiscountAmountAttribute()
    {
        return optional($this->discount)->amount;
    }

    function getDiscountTypeAttribute()
    {
        return optional($this->discount)->type;
    }

    function getDiscountTotalAmount()
    {
        return (new CouponDiscountCalculator($this))->process() ?: 0;
    }

    /**
     * Discount label attribute
     * @return string
     */
    function getDiscountLabelAttribute()
    {
        if (optional($this->discount)->type == Discount::PERCENT) {
            return $this->discount_code . ' (' . $this->discount->amount . '%)';
        }
        return $this->discount_code;
    }


    function cartGrandTotal()
    {
        $shipping_cost               = $this->getShipping();
        $product_total_with_discount = $this->getTotalProductsWithDiscount();
        $payment_fee                 = $this->getPaymentFeeAmount();
        return $product_total_with_discount + $shipping_cost + $payment_fee;
    }

    function getTotalProducts()
    {
        return StoreHelper::getCartTotal($this);
    }

    function getTotalProductsWithDiscount()
    {
        $product_total   = $this->getTotalProducts();
        $discount_amount = $this->getDiscountTotalAmount();
        return ($product_total - $discount_amount > 0) ? $product_total - $discount_amount : 0;
    }

    function getPaymentFeeAmount()
    {
        if ($this->payment_method) return (new StandardPaymentFeeCalculator($this->payment_method))->process() ?: 0;
    }

    function getShipping()
    {
        return $this->shipping_cost;
    }

    function getVat()
    {
        return null;
    }

    function getShipmentLastnameAttribute()
    {
        $lastname = (auth_user()) ? auth_user()->lastname : '';
        return data_get($this->shipping_address, 'lastname', $lastname);
    }

    function getShipmentFirstnameAttribute()
    {
        $firstname = (auth_user()) ? auth_user()->firstname : '';
        return data_get($this->shipping_address, 'firstname', $firstname);
    }

    function getShipmentEmailAttribute()
    {
        $email = (auth_user()) ? auth_user()->email : '';
        return data_get($this->shipping_address, 'email', $email);
    }

    function getBillingLastnameAttribute()
    {
        $lastname = (auth_user()) ? auth_user()->lastname : '';
        return data_get($this->billing_address, 'lastname', $lastname);
    }

    function getBillingFirstnameAttribute()
    {
        $firstname = (auth_user()) ? auth_user()->firstname : '';
        return data_get($this->billing_address, 'firstname', $firstname);
    }

    function getBillingEmailAttribute()
    {
        $email = (auth_user()) ? auth_user()->email : '';
        return data_get($this->billing_address, 'email', $email);
    }

    function prefillAddressIfPresent()
    {
        if (auth_user()) {

            $latestOrder = optional(auth_user()->orders())->latest()->first();
            if ($latestOrder) {
                $this->shipping_address_id = $latestOrder->shipping_address_id;
                $this->save();
            };
        }
    }
}
