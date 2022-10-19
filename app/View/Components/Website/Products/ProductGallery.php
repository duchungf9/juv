<?php

namespace App\View\Components\Website\Products;

use App\Model\Product;
use App\View\Components\Website\Media\MediaCarousel;
use Illuminate\Contracts\View\View;


class ProductGallery extends  MediaCarousel
{
    public $item;
    /**
     * @var mixed|string
     */
    public $carousel_identifier;

     /**
     * @property string config
     */

    public string $config;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item,string $config,string $carousel_identifier="product-gallery")
    {
        $this->item = $item;
        $this->carousel_identifier = $carousel_identifier;
        $this->config =$config;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return ($this->item->hasGallery())
                ? view('components.website.products.product-gallery')
                : view('components.website.products.product-image');
    }
    public function gallery()
    {
        return $this->item->gallery()->sorted()->get();
    }
}