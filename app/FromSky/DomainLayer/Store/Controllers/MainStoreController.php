<?php

namespace App\FromSky\DomainLayer\Store\Controllers;


use Auth;
use Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\FromSky\Definition\Definition;
use App\FromSky\DomainLayer\Store\Cart\CartVieModel;
use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use App\FromSky\Website\Requests\WebsiteFormRequest;

class MainStoreController extends Controller
{
    public function __construct()
    {
    }

    public function orderSubmit()
    {
        if (!auth_user()) {
            return Redirect::to(url_locale('/order-login'));
        }

        $cart = new CartVieModel();
        if (!$cart) {
            session()->flash('error', trans('store.alerts.cart_invalid'));
            return back();
        }
        if ($cart->isEmpty()) {
            session()->flash('error', trans('store.alerts.cart_empty'));
            return back();
        }
        return redirect(url_locale('cart/' . Definition::CART_STEP_ADDRESS));;

    }

    public function orderLogin()
    {
        $redirectTo    = 'cart/' . Definition::CART_STEP_ADDRESS;
        $with_register = true;
        return view('fromsky_store::login', compact('redirectTo', 'with_register'));
    }


    public function orderPayment(WebsiteFormRequest $request)
    {
        $order_id          = $request->order_id;
        $payment_method_id = $request->payment_method_id;
        $payment           = StoreHelper::createPayment($order_id, $payment_method_id);

        if (!$payment) {
            session()->flash('error',);
            return back();
        }
        $response = StoreHelper::processPayment($payment);

        if ($response['status'] == 'ok') {
            return redirect($response['text']);
        }

        $order = $payment->order;
        session()->flash('error', $response['text']);
        return Redirect::to(url_locale('/order-payment-result/' . $order->token));

    }


    public function orderConfirm(Request $request, $token)
    {
        $order = StoreHelper::getOrderByToken($token);
        if (!$order) {
            session()->flash('error', trans('store.alerts.payment_fail'));
            return Redirect::to('/');
        }
        $payment = $order->payment;
        if ($payment->is_paid) {
            session()->flash('error', trans('store.alerts.payment_already_paid'));
            return Redirect::to(url_locale('/order-payment-result/' . $order->token));
        }
        $response = StoreHelper::confirmPayment($payment, $request);
        dd($response);
        if ($response) {
            session()->flash('error', $response);
            return Redirect::to(url_locale('/order-payment-result/' . $order->token));
        } else {
            session()->flash('success', trans('store.alerts.payment_success'));
            return Redirect::to(url_locale('/order-payment-result/' . $order->token));
        }
    }


}
