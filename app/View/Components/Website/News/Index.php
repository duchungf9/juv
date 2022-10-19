<?php

namespace App\View\Components\Website\News;


use App\Model\News;
use Illuminate\View\Component;

class Index extends Component
{
    /**
     * @var News
     */
    public $news;



    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.news.index');
    }

    function posts($tag = '')
    {
        $this->news = News::itemList($tag,10);
        $this->news->load('imageMedia');
        return $this->news;
    }

    function paginate()
    {
        return $this->news->links();
    }
}
