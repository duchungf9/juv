<?php


namespace App\FromSky\DomainLayer\Store\Controllers\Payment;


use App\Model\Cart;
use App\Model\Country;

use App\FromSky\DomainLayer\Store\Controllers\CartStepController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;


class OrderPaymentController extends CartStepController
{


    public function orderPaymentConfirm(Request $request)
    {

        $response = StoreHelper::confirmPayment('paypal', $request);

        if (!is_object($response)) {
            session()->flash('error', $response);
            $cart = StoreHelper::getSessionCart();
            return Redirect::to(url_locale('/order-payment-cancel/' . $cart->token));
        } else {
            session()->flash('success', trans('store.alerts.payment_success'));
            return Redirect::to(url_locale('/order-confirm/' . $response->token));
        }

    }

    public function cancel(Cart $cart)
    {
        if (optional($cart)->hasStep()) {
            session()->flash('message', trans('store.alerts.payment_cancel'));
            $countries       = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('fromsky_store::cart.step_confirm_order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();
    }
}
