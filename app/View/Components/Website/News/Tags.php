<?php

namespace App\View\Components\Website\News;

use App\Model\Tag;
use Illuminate\View\Component;
use App\Model\News;

/**
 * Class Sidebar
 * @package App\View\Components\Website\News
 */
class Tags extends Component
{
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
        return view('components.website.news.tags');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function  tags(){
        return Tag::query()->withCount(['news'])->orderBy('title')->get();
    }
}
