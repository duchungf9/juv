<?php


namespace App\FromSky\DomainLayer\Store\Support;


use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use App\FromSky\DomainLayer\Store\StoreHelper;

trait AddCartToUserAfterLogin
{
    function addCartToLoggedUser($user)
    {

        request()->session()->regenerate();

//        if (StoreFeatures::isStoreEnabled()) {
//            // if the user has an active cart, store it to the new session
//            $cart = StoreHelper::getSessionCart();
//            if ($cart) {
//                $cart->user()->associate($user);
//                $cart->save();
//            } else {
//                $cart = StoreHelper::getUserCart();
//            }
//            if ($cart) StoreHelper::setSessionCart($cart);
//        }
    }
}
