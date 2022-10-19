<?php

namespace App\View\Components\Website\Carousels;

use Illuminate\View\Component;
use App\Model\HpSlider;

class InvestmentCarousel extends Component
{

    public string $classList = '';

   /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $classList)
    {
        $this->classList = $classList;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.carousels.investment-carousel');
    }

    /**
     * get th HP slides
     * @return mixed
     */
    public function slides(){

        return HpSlider::active()->get();
    }


}
