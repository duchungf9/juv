<?php

namespace App\View\Components\Media;

use Illuminate\View\Component;

abstract class EmbedComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $url;
    public function __construct()
    {
        //
    }
    abstract  function getUrl();
}
