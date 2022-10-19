<?php

namespace App\View\Components\Website\Ui;

use Illuminate\View\Component;

class InputErrorLabel extends Component
{
    public string $for;

    /**
     * FormErrorLabel constructor.
     * @param $for
     */
    public function __construct($for)
    {
        //
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.website.ui.input-error-label');
    }
}
