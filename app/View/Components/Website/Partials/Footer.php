<?php

namespace App\View\Components\Website\Partials;

use Illuminate\View\Component;

class Footer extends Component
{
    public $locale_page;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($localePage)
    {
        //
        $this->locale_page = $localePage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $isHome = request()->is('/');
        $locale_page = $this->locale_page;
        $page = $locale_page;
        return view('components.website.partials.footer',compact('isHome','locale_page','page'));
    }
}
