<?php

namespace App\View\Components\Website\News;

use App\Model\Category;
use Illuminate\View\Component;
use App\Model\News;

/**
 * Class Sidebar
 * @package App\View\Components\Website\News
 */
class GoodNews extends Component
{
    /**
     * @var Category
     */
    public $category;
    public $news;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        if ($category->id == null) {
            $this->category = reGet(__METHOD__, function () {
                return Category::where("id", 5)->first();
            });
        } else {
            $this->category = $category;
        }

        $class      = $this;
        $this->news = reGet(__METHOD__ . 'news', function () use ($class) {
            return $class->category->news()->published()->orderBy('hits', 'desc')->limit(6)->get();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.news.good-news');
    }

    public function news()
    {
        $class = $this;
        return reGet(__METHOD__ . 'news', function () use ($class) {
            return $class->category->news()->published()->orderBy('hits', 'desc')->limit(6)->get();
        });
    }

}
