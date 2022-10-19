<?php

namespace App\FromSky\DomainLayer\SocialAccount\View\Components;

use App\Model\Address;
use Illuminate\View\Component;

class LoginComponent extends Component
{

    /**
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     *
     * @param string $label
     */
    public function __construct(string $label)
    {
        //
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('fromsky_social::login');
    }
}
