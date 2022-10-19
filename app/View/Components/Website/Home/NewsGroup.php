<?php

namespace App\View\Components\Website\Home;

use Illuminate\View\Component;

use App\Model\News;


/**
 * Class Slider
 * @package App\View\Components\Website\Home
 */

class NewsGroup extends Component
{
    private $orderBy = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $orderByOut = $this->orderBy;
        return view('components.website.home.news-group',compact('orderByOut'));
    }

    /**
     * list new
     */
    function news(){
        return News::published()->limit(4)->orderBy($this->orderBy,'desc')->get();
    }
}
