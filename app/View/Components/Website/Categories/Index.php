<?php

namespace App\View\Components\Website\Categories;

use App\Model\Category;
use Illuminate\View\Component;

class Index extends Component
{
    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.categories.index');
    }

    //get categories  sorted by title
    function categories(){
        /** @var TYPE_NAME $categories */
        return $this->categories = Category::published()->orderBy('title')->get();
    }
    //get categories  sorted by sort asc
    function categories_sorted(){
        /** @var TYPE_NAME $categories */
        return $this->categories = Category::sorted()->get();
    }
}
