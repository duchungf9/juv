<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use App\Model\Order;
use Illuminate\View\Component;

class OrderListComponent extends Component
{

    /**
     * @var Orders
     */
    public $orders;

    public function __construct()
    {

        $this->orders = auth_user()->orders()->latest()->list()->get();;
    }


    public function render()
    {
        return view('fromsky_store::order.list');
    }
}
