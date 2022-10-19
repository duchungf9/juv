<?php


namespace App\FromSky\DomainLayer\Store\Api;


use App\Model\Discount;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\Website\Requests\AjaxFormRequest;

/**
 * Class CouponValidateController
 * @package App\FromSky\DomainLayer\Store\Api
 * VALIDATE COUPON
 */
class CouponValidateController extends StoreAPIController
{
    public function __invoke(AjaxformRequest $request)
    {

        $discount = Discount::getByCode($request->code)->first();
        $cart     = StoreHelper::getSessionCart();
        if (optional($discount)->checkDiscount() && $cart) {
            $cart->addDiscount($request->code);
            $msg = sprintf(trans('store.order.discount.valid'), $discount->label);
            return $this->responseSuccess($msg)->apiResponse();
        }

        $msg = trans('store.order.discount.invalid');

        return $this->responseWithError($msg)->apiResponse();
    }

}