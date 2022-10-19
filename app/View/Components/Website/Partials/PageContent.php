<?php

namespace App\View\Components\Website\Partials;

use Illuminate\View\Component;

class PageContent extends Component
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
        $this->page = $page;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.partials.page-content');
    }

    // evaluate if page Content has media
    public function contentHasMedia()
    {
        if($this->page->image!='') return true;
        if($this->page->video!='') return true;
        return false;
    }
}
