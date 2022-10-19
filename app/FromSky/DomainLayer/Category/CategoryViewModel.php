<?php

namespace App\FromSky\DomainLayer\Category;

use App\FromSky\Website\Controllers\NewsController;
use App\Model\Category;
use App\FromSky\DomainLayer\Website\WebsiteViewModel;
use App\Model\News;
use Cache;

class CategoryViewModel extends WebsiteViewModel
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function index()
    {
        $page = $this->getCurrentPage();
        $this->setSeo($page);
        $template = ($page->template_id) ? $page->template->value : 'categories';
        return view('website.' . $template, ['page' => $page]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Render UI for category or sub cat
     * @throws \Exception
     */
    function show($slug)
    {
        $arrSlug  = explode('/', $slug);
        $key      = __METHOD__ . md5($slug);
        $category = reGet($key, function () use ($arrSlug) {
            return Category::findBySlug(end($arrSlug), app()->getLocale());
        });
        if ($category) {
            $page = $this->getCurrentPage();// trường hợp child category sẽ lấy thằng root lớn nhất của page1
            $this->setSeo($category);
            $locale_page = $category;
            $news        = reGet($key . 'news', function () use ($category) {
                return $category->news()->published()->orderBy('date', 'desc')->paginate(11);
            });


            $this->setPagination($news);

            /**
             * Case go category has parent
             */
            $categoryParent = reGet($key . 'cat_categoryParent', function () use ($category) {
                return $category->parent;
            });
            if ($categoryParent !== null) {
                $categoryChildren = reGet($key . 'cat_categoryChildren1', function () use ($categoryParent) {
                    return $categoryParent->children;
                });
                return view('website.category-sub', compact('page', 'category', 'news', 'locale_page', 'categoryParent', 'categoryChildren'));
            }

            /**
             * Case has many child category
             */
            $categoryChildren = reGet($key . 'cat_categoryChildren2', function () use ($category) {
                return $category->children;
            });
            if (count($categoryChildren) > 0) {
                $news = reGet($key . 'news_children_parent', function () use ($categoryChildren, $category) {
                    $arrIdCat   = $categoryChildren->pluck('id');
                    $arrIdCat[] = $category->id;
                    return News::published()->whereIn('category_id', $arrIdCat)->orderBy('date', 'desc')->paginate(11);
                });
                $this->setPagination($news);
            }
            return view('website.category', compact('page', 'category', 'news', 'locale_page', 'categoryChildren'));
        }

        //move to tag view if not find category
        return (new NewsController())->newsByTags(end($arrSlug));
//        return $this->handleMissingPage();
    }


}
