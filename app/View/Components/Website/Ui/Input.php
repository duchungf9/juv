<?php

namespace App\View\Components\Website\Ui;

use Illuminate\View\Component;

class Input extends Component
{
    public string $for;
    public string $type;
    public bool $enableError;

    /**
     * Input constructor.
     * @param $for
     * @param string $type
     * @param bool $enableError
     */
    function __construct($for, string $type='text', bool $enableError=true)
    {
        //
        $this->for = $for;
        $this->type = $type;
        $this->enableError = $enableError;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.website.ui.input');
    }
}
