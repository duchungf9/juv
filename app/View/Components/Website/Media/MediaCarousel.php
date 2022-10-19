<?php

namespace App\View\Components\Website\Media;


use Illuminate\View\Component;

class MediaCarousel extends Component
{
    public $item;
    /**
     * @var mixed|string
     */
    public $carousel_identifier;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item,$carousel_identifier="page-carousel")
    {
        //
        $this->item = $item;
        $this->carousel_identifier = $carousel_identifier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.website.media.media-carousel');
    }

    public function gallery()
    {
        return $this->item->gallery()->sorted()->get();
    }


}
