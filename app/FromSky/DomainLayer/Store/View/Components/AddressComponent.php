<?php

namespace App\FromSky\DomainLayer\Store\View\Components;

use App\Model\Address;
use Illuminate\View\Component;

class AddressComponent extends Component
{
    /**
     * @var Address
     */
    public $address;
    /**
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     * @param Address $address
     * @param string $label
     */
    public function __construct(Address $address, string $label)
    {
        //
        $this->address = $address;
        $this->label   = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('fromsky_store::partials.address');
    }
}
