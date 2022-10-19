<?php

namespace App\FromSky\DomainLayer\Store\Action;

use App\Model\Discount;
use App\FromSky\Website\Facades\FromSkyFeatures;
use Illuminate\Support\Str;

class AddCouponToNewsletter
{


    public function execute()
    {
        if (!FromSkyFeatures::hasFeature('newsletter_add_welcome_coupon')) {
            return false;
        }
        if ($discount_attributes = $this->getCouponAttributes()) {
            return (new CreateCouponAction($discount_attributes[0], $discount_attributes[1]))->execute();
        }
        return false;
    }

    /**
     * @return array|void
     */
    private function getCouponAttributes()
    {

        $coupon_value = FromSkyFeatures::getFeature('newsletter_coupon_discount_amount');
        if ($coupon_value) {
            $discount_amount = $this->getCouponAmount($coupon_value);
            $discount_type   = $this->getCouponType($coupon_value);
            return [$discount_type, $discount_amount];
        }
        return null;
    }

    /**
     * @param $coupon_value
     * @return string
     */
    private function getCouponType($coupon_value)
    {

        return (Str::of($coupon_value)->trim()->contains('%'))
            ? Discount::PERCENT
            : Discount::AMOUNT;
    }

    /** cast coupon value to int
     * @param $coupon_value
     * @return string
     */
    private function getCouponAmount($coupon_value)
    {
        return (int)$coupon_value;
    }
}