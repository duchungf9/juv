<?php


namespace App\FromSky\DomainLayer\Store;


use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use Illuminate\Support\Str;

trait OrderPresenter
{


    public function getProductsCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->products_cost);
    }

    public function getShippingCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->shipping_cost);
    }

    public function getVatCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->vat_cost);
    }

    public function getTotalCostDisplayAttribute()
    {
        return StoreHelper::formatPrice($this->total_cost);
    }

    public function getOrderReferenceAttribute()
    {
        return $this->reference;
    }

    public function getCouponDisplayAttribute()
    {
        return ($this->discount_code) ? $this->discount_code . '<br>' . StoreHelper::formatPrice($this->discount_amount) : '';
    }


    static public function generateReference()
    {

        $reference = strtoupper(Str::random(8));

        $validator = \Validator::make(['reference' => $reference], ['id' => 'unique:orders,reference']);

        if ($validator->fails()) {
            return self::generateReference();
        }

        return $reference;
    }

    function orderFeedback($description)
    {
        $description = str_replace('[reference]', $this->order_reference, $description);
        $description = str_replace('[order_email]', config('fromSky.website.option.app.email_order'), $description);
        return $description;
    }

    function getDiscountLabel()
    {

        return '<span class="label">' . __('store.order.discount.title') . ' (<strong>' . $this->discount_code . '</strong>)</span>';
    }


    public function getPermalink()
    {
        return url_locale('/order-review/' . $this->token);
    }


}