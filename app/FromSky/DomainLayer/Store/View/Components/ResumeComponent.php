<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use App\Model\Address;
use App\Model\Order;
use Illuminate\View\Component;

class ResumeComponent extends Component
{

    /**
     * @var Order
     */
    public $order;

    public function __construct(Order $order)
    {

        $this->order = $order;
    }


    public function render()
    {
        return view('fromsky_store::partials.resume');
    }
}
