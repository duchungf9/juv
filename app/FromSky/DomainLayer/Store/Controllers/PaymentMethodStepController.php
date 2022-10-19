<?php


namespace App\FromSky\DomainLayer\Store\Controllers;


use App\Model\Country;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Action\ShippingCostAction;
use App\FromSky\DomainLayer\Store\Shipping\StandardShippingCostCalculator;


class PaymentMethodStepController extends CartStepController
{

    function autorize($ability, $arguments = [])
    {
        return false;
    }

    public function view()
    {

        $cart = $this->getCart();
        if (optional($cart)->hasStep()) {
            $countries       = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            return view('fromsky_store::cart.step_payment_and_shipping_methods', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();

    }

    function store(PaymentMethodFormRequest $request)
    {
        $cart = $this->getCart();
        $cart->add_payment_and_shipment($request->only('shipping_method_id', 'payment_method_id'));

        return redirect(url_locale('/cart/resume'));
    }
}