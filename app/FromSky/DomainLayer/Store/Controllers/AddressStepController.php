<?php


namespace App\FromSky\DomainLayer\Store\Controllers;


use App\Model\Country;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\FromSky\DomainLayer\Store\Action\UpdateCartAddressAction;


class AddressStepController extends CartStepController
{


    public function view()
    {
        $cart = $this->getCart();

        if (optional($cart)->hasStep()) {
            $countries       = Country::list()->get();
            $payment_methods = StoreHelper::getPaymentMethods();
            $cart->prefillAddressIfPresent();
            return view('fromsky_store::cart.step_address', compact('cart', 'countries', 'payment_methods'));
        }
        return $this->handleMissingStep();
    }

    function store(AddressFormRequest $request)
    {
        $cart = $this->getCart();;
        (new UpdateCartAddressAction($cart))->execute($request);
        return redirect(url_locale('/cart/payment'));
    }
}