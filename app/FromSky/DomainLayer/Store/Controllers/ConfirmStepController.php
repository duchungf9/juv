<?php


namespace App\FromSky\DomainLayer\Store\Controllers;


use App\Model\Cart;
use App\Model\Country;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;


class ConfirmStepController extends CartStepController
{


    public function view()
    {
        $cart = $this->getCart();
        if (optional($cart)->hasStep()) {
            $result = $cart->calculate_shipping_cost();
            if ($this->shippingHasError($result)) {
                session()->flash('message', __('store.alerts.shipping_address_invalid', ['ERROR' => $result['message']]));
                return redirect(url_locale('/cart/address'));
            }

            $countries       = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('fromsky_store::cart.step_confirm_order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();

    }

    public function cancel(Cart $cart)
    {

        if (optional($cart)->hasStep()) {
            $countries       = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('fromsky_store::cart.step_confirm_order', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();
    }
}
