<?php

namespace App\View\Components\Website\Home;

use App\Model\Category;
use App\Model\Ico;
use Illuminate\View\Component;

use App\Model\News;


/**
 * Class Slider
 * @package App\View\Components\Website\Home
 */
class BodyTop extends Component
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
        $orderByOut   = $this->orderBy;
        $categories   = $this->newsByCategory();
        $arrBigNewsId = $this->newsPinHome()->pluck('id')->toArray();
        $ico          = $this->icoItems();
        return view('components.website.home.body-top', compact('orderByOut', 'categories', 'arrBigNewsId', 'ico'));
    }

    function newsPinHome()
    {
        return reGet(__METHOD__, function () {
            return News::select(['title', 'id', 'slug', 'category_id', 'image', 'date'])
                       ->published()
                       ->where('is_home', true)
                       ->orderBy("date", "DESC")
                       ->orderBy("id", "DESC")
                       ->limit(7)->get();
        });
    }

    /**
     * list new
     */
    function newsByCategory()
    {
        return reGet('newsByCategoryHome', function () {
            return Category::with(["news" => function ($query) {
                return $query->select(['title', 'id', 'slug', 'category_id', 'image', 'date'])
                             ->published()
                             ->orderBy("is_pin", "DESC")
                             ->orderBy("date", "DESC")
                             ->orderBy("id", "DESC")
                             ->limit(20)->get();
            }])->get();
        });
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    function topCoinHot()
    {
        return reGet(__METHOD__, function () {
            return News::select(['title', 'id', 'slug', 'category_id', 'date'])
                       ->published()
                       ->where('category_id', 1)
                       ->orderBy("date", "DESC")
                       ->orderBy("id", "DESC")
                       ->limit(10)->get();
        });
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    function icoItems()
    {
        return reGet('icItem', function () {
            return collect([]);
        });
    }
}
