<?php

namespace App\FromSky\Website\Controllers;


use App\FromSky\DomainLayer\Category\CategoryViewModel;
use Illuminate\Http\RedirectResponse;
use Validator;
use App\Http\Controllers\Controller;

use App\FromSky\DomainLayer\Faq\FaqViewModel;
use App\FromSky\DomainLayer\News\NewsViewModel;
use App\FromSky\DomainLayer\Page\PageViewModel;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;

/**
 *
 */
class NewsController extends Controller
{

    /**
     * @param string $category_slug
     * @return mixed
     */
    public function category(string $category_slug = '')
    {
        $slug = $this->resolvePageSlug();
        return (new CategoryViewModel(''))->handle($slug);
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function news(string $slug = ''): mixed
    {
        return (new NewsViewModel(''))->handle($slug);
    }


    /**
     * @param string $tag
     * @return Factory|View|Application
     */
    public function newsByTags(string $tag): Factory|View|Application
    {
        return (new NewsViewModel(''))->index($tag);
    }


    /**
     * @param string $slug
     * @return Factory|View|Application
     */
    public function newShow(string $category_slug): Factory|View|Application|RedirectResponse
    {
        $slug = str_replace(".html","",last(request()->segments())); // rtrim bị cắt ký tự cuối
        return (new NewsViewModel(''))->show($slug);
    }

    /**
     * @return mixed
     */
    private function resolvePageSlug(): mixed
    {
        $segments = request()->segments();
        $locale   = app()->getLocale();
        if ($segments[0] === "vi") {
            unset($segments[0]);
        }
        return join('/',$segments);
    }
}
