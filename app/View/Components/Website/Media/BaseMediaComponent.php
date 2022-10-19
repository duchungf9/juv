<?php

namespace App\View\Components\Website\Media;

use Illuminate\View\Component;

class BaseMediaComponent extends Component
{
    public $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        //
        $this->item = $item;
    }


    public function gallery()
    {
        return $this->item->gallery()->sorted()->get();
    }

    public function hasImageGallery()
    {
        return $this->item->hasGallery();
    }

    public function render()
    {
        // TODO: Implement render() method.
    }
}
