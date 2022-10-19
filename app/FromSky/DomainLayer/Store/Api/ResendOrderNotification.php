<?php

namespace App\FromSky\DomainLayer\Store\Api;

use Illuminate\Support\Facades\Auth;

use App\Model\Order;
use App\FromSky\Tools\JsonResponseTrait;
use App\FromSky\Website\Requests\AjaxFormRequest;
use App\FromSky\Website\Controllers\APIController;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use App\FromSky\DomainLayer\Store\Controllers\OrderControllers;
use App\FromSky\DomainLayer\Store\Notifications\NewOrderNotification;

/*
|--------------------------------------------------------------------------
| SET METHODS FOR AJAX STORE REQUESTS
|--------------------------------------------------------------------------
*/

/**
 * Class StoreAPIController
 * @package App\FromSky\DomainLayer\Store\Api
 */
class ResendOrderNotification extends APIController
{
    public function __invoke(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id == $user->id) {

            $user->notify(new NewOrderNotification($order, false));

            $message = [
                'text' => __('store.notification.order_resent'),
                'type' => 'success',
            ];

            return $this->setMsg($message)->responseSuccess()->apiResponse();
        }

        return $this->apiResponse();
    }
}
