<?php

namespace App\FromSky\DomainLayer\SocialAccount\View\Components;

use App\Model\Address;
use Illuminate\View\Component;

class HeaderComponent extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('fromsky_social::header');
    }

}
