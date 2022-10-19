<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use Illuminate\View\Component;

class ProductDisplayPrice extends Component
{
    public $product;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product, $type)
    {
        //
        $this->product = $product;

        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('fromsky_store::product.price-display');
    }
}
