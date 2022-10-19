<?php


namespace App\FromSky\DomainLayer\Store\Controllers\Payment;


use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\FromSky\DomainLayer\Store\Facades\StoreHelper;

class StorePaymentManagerController extends Controller
{


    function handle()
    {

        $cart = StoreHelper::getSessionCart();
        switch ($cart->payment_method_id) {
            case '1': // paypal
                $response = StoreHelper::processPayment('paypal');
                if ($response['status'] == 'ok') {
                    return redirect($response['text']);
                } else {
                    $message = trans('store.alerts.payment_fail');
                    session()->flash('message', $message . '<br>' . $response['text']);
                    return redirect(url_locale('/cart/address'));
                }
                break;
            case '2': //bonifico

                $order = (new BankTransfer($cart))->process();
                if ($order instanceof Order) {
                    return Redirect::to(url_locale('/order-confirm/' . $order->token));
                } else {
                    $message = trans('store.alerts.payment_fail');
                    session()->flash('message', $message);
                    return redirect(url_locale('/cart/address'));
                }

                break;

            case '3': //cash
                $order = (new CashPayment($cart))->process();
                if ($order instanceof Order) {
                    return Redirect::to(url_locale('/order-confirm/' . $order->token));
                } else {
                    $message = trans('store.alerts.payment_fail');
                    session()->flash('message', $message);
                    return redirect(url_locale('/cart/address'));
                }
                break;
        }

    }
}
