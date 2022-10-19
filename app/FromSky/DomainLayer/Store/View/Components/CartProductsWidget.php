<?php


namespace App\FromSky\DomainLayer\Store\View\Components;


use Illuminate\View\Component;
use Illuminate\View\View;

class CartProductsWidget extends Component
{
    public $cart;

    public function __construct($cart)
    {
        $this->cart = $cart;
    }

    public function render(): View
    {
        return view('fromsky_store::cart.products_widget');
    }
}