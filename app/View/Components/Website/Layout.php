<?php

namespace App\View\Components\Website;

use Illuminate\View\Component;

class Layout extends Component
{
    public $page;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page)
    {
        //
        $this->page =$page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.layout');
    }
}
