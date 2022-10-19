<?php


namespace App\FromSky\DomainLayer\Store\Api;


use App\FromSky\DomainLayer\Store\Facades\StoreHelper;

class CouponDeleteController extends StoreAPIController
{
    public function __invoke()
    {
        $cart = StoreHelper::getSessionCart();
        if ($cart) {
            $cart->removeDiscount();
            $message = [
                'text' => __('store.order.discount.coupon_deleted'),
                'type' => 'success',
            ];
            return $this->setMsg($message)->responseSuccess()->apiResponse();
        }

        return $this->responseNotFound()->apiResponse();
    }
}