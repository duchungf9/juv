<?php


namespace App\FromSky\Website\Controllers\Store;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Notifications\NewOrderNotification;

/**
 * Class OrderResultController
 * @package App\FromSky\Website\Controllers\Store
 */
class OrderResultController extends Controller
{


    public function view($token)
    {
        $user = Auth::user();

        $order = StoreHelper::getOrderByToken($token);

        if ($order) {
            $payment = $order->payment;
            $user->notify(new NewOrderNotification($order));

            return view('fromsky_store::order.confirm', compact('order', 'payment'));
        } else {
            return Redirect::to('/');
        }
    }

}
