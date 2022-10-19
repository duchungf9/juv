<?php


namespace App\FromSky\DomainLayer\Store\Controllers;


use App\Http\Controllers\Controller;
use App\FromSky\DomainLayer\Store\Cart\CartVieModel;

class CartController extends Controller
{
    public function __invoke()
    {
        $cart = new CartVieModel();
        return view('fromsky_store::cart.detail', compact('cart',));
    }
}