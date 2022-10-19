<?php

namespace App\FromSky\DomainLayer\Store\Api;


use App\FromSky\Tools\JsonResponseTrait;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\Website\Requests\AjaxFormRequest;
use App\FromSky\Website\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| SET METHODS FOR AJAX STORE REQUESTS
|--------------------------------------------------------------------------
*/

/**
 * Class StoreAPIController
 * @package App\FromSky\DomainLayer\Store\Api
 */
class StoreAPIController extends APIController
{
    private array $response = [];
    use JsonResponseTrait;

    public function __construct()
    {
    }

    public function storeCartItemAdd(AjaxFormRequest $request)
    {
        $result = StoreHelper::cartItemAdd($request->only('product_code', 'quantity', 'product_model'));
        if ($result) {
            $message = [
                'text' => trans('store.alerts.add_success'),
                'type' => 'success',
                'time' => 3
            ];
            $this->setData($result)->responseSuccess();
        } else {
            $message = [
                'text' => trans('store.alerts.add_fail'),
                'type' => 'warning',
                'time' => 5
            ];
        }
        return $this->setMsg($message)->apiResponse();
    }


    public function updateItemQuantity(AjaxFormRequest $request)
    {
        $result = StoreHelper::updateItemQuantity($request->only('id', 'quantity'));
        if ($result) {
            $message = [
                'text' => trans('store.alerts.add_success'),
                'type' => 'success',
                'time' => 3
            ];
            $this->setData($result)->responseSuccess();
        } else {
            $message = [
                'text' => trans('store.alerts.add_fail'),
                'type' => 'warning',
                'time' => 5
            ];
        }
        return $this->setMsg($message)->apiResponse();
    }

    public function storeCartItemRemove(AjaxFormRequest $request)
    {
        $result = StoreHelper::cartItemRemove($request->id);
        if ($result) {
            $message = [
                'text' => trans('store.alerts.remove_success'),
                'type' => 'success',
                'time' => 3
            ];
            $this->setData($result)->responseSuccess();
        } else {
            $message = [
                'text' => trans('store.alerts.remove_fail'),
                'type' => 'warning',
                'time' => 5
            ];
        }
        return $this->setMsg($message)->apiResponse();
    }
}
