<?php

namespace App\FromSky\DomainLayer\News;


use App\FromSky\Website\Controllers\WebsiteFormController;
use App\Model\Category;
use App\Model\News;
use App\FromSky\DomainLayer\Website\WebsiteViewModel;
use App\Model\Tag;
use Exception;
use \Illuminate\Contracts\View\Factory;
use \Illuminate\Contracts\View\View;
use \Illuminate\Contracts\Foundation\Application;
use \Illuminate\Routing\Redirector;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use SEO;


/**
 *
 */
class NewsViewModel extends WebsiteViewModel
{

    /**
     * @param string $tagSlug
     * @return Factory|View|Application
     * @throws Exception
     */
    public function index(string $tagSlug = ''): Factory|View|Application
    {
        $news = News::itemList($tagSlug);
        $tag  = reGet(__METHOD__ . $tagSlug, function () use ($tagSlug) {
            return Tag::whereTranslation('slug', $tagSlug)->first();
        });
        if (is_null($tag)) {
            return (new WebsiteFormController())->routerGetSearch(str_replace('.',' ',str_replace('-',' ',$tagSlug)));
        }
        $this->setSeo($tag);
        $this->setPagination($news);
        $category = reGet(__METHOD__ . $tagSlug . '_category', function () use ($news) {
            if (count($news) > 0) {
                return $news[0]->category;
            }
            return Category::first();
        });
        return view('website.news.tag', compact('tag', 'news', 'category'));
    }

    /**
     * @param string $slug
     * @return View|Factory|Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function show(string $slug): View|Factory|Redirector|Application|RedirectResponse
    {
        $post = reGet(__METHOD__ . '_data_' . $slug, function () use ($slug) {
            return News::findBySlug($slug, app()->getLocale());
        });
        if ($post) {
            $this->setSeo($post);
            $compact = $this->returnDataPost($post);
            $menu            = $this->buildMenuFromContent($compact['post']->description);
            $compact['menu'] = $menu;
            if ($compact['category']->id === 1) {
                if ($menu->count() == 0) {
                    return view('website.news.single', $compact);
                }
                return view('website.news.single-sidemenu', $compact);
            }
            return ($menu->count() == 0) ? view('website.news.single', $compact) : view('website.news.single-sidemenu', $compact);
        }
        return abort(404, 'missing page');
    }


    /*
     *
     */
    private function buildMenuFromContent($content)
    {
        $string       = $content;
//        $regex_string = "/<h([0-9])>((.*)+)<\/h[0-9]>+/";
        $regex_string = '/<h([0-9]) ?(.*)?>(<strong>)?((.*)+)?(<\/strong>)?<\/h[0-9]>/';
        $matched      = preg_match_all($regex_string, $string, $out, PREG_PATTERN_ORDER);
        $headings     = $out[1];
        $menu         = collect([]);
//        dd($out);
        if (count($out[1]) == 0) {
            return $menu;
        }

        $min_heading = min($headings);
        $max_heading = max($headings);
        foreach ($headings as $key => $heading) {
            if (!empty(trim($out[0][$key]))) {
                $menuObj = (object)['level' => $heading, 'title' => strip_tags($out[0][$key]), 'display_heading' => 1, 'id' => $key, 'parent_id' => null];
                if ($menuObj->level == $min_heading) {
                    $menu->push($menuObj);
                } else {
                    $prev_menuObj = $menu->where("id", $key - 1)->first();

                    if($prev_menuObj != null){
                        if ($menuObj->level == ($prev_menuObj->level  + 1)) {
                            $menuObj->parent_id = $prev_menuObj->id;
                            $menu->push($menuObj);
                        }
                        if ($menuObj->level == $prev_menuObj->level ) { // trường hợp bằng thằng level trên
                            $menuObj->parent_id = $prev_menuObj->parent_id;
                            $menu->push($menuObj);
                        }
                    }


                }
            }

        }
//        dd($menu, $out);
        return $menu;
    }

    /**
     * @param $post
     * @return mixed
     * @throws Exception
     */
    private function returnDataPost($post): mixed
    {
        return reGet(__METHOD__ . '_data_' . $post->id, function () use ($post) {
            $locale_page      = $post;
            $category         = $post->category;
            $news             = $category->news()->select(['title','id','slug','category_id','image'])->published()->where('date', '<', $post->date)->orderBy('date', 'desc')->paginate(11);
            $categoryParent   = [$category];
            $categoryParent[] = (($categoryParent[0]->parent ?? null) !== null) ? $categoryParent[0]->parent : null;
            $categoryParent[] = (($categoryParent[1]->parent ?? null) !== null) ? $categoryParent[1]->parent : null;
            $categoryParent[] = (($categoryParent[2]->parent ?? null) !== null) ? $categoryParent[2]->parent : null;
            $categoryParent[] = (($categoryParent[3]->parent ?? null) !== null) ? $categoryParent[3]->parent : null;
            $categoryParent   = array_reverse($categoryParent, true);
            $page = $post;
            return compact('post', 'category', 'news', 'categoryParent', 'locale_page','page');
        });
    }


    /**
     * @param null $inputKw
     * @return mixed
     * @throws \Exception
     */
    public function buildSearch($inputKw = null)
    {
        $kw = is_null($inputKw)?'tin tuc':$inputKw;
        $searchResult =  $this->getCacheSearch($kw);
        //first recall
        $arrKw = explode(' ',$kw);
        if($searchResult->total()===0){
            $kw2 = end($arrKw);
            if(!empty($kw2)){
                $searchResult = $this->getCacheSearch($kw2);
            }
        }
        //two recall
        if($searchResult->total()===0){
            $kw2 = $arrKw[0];
            if(!empty($kw2)){
                $searchResult = $this->getCacheSearch($kw2);
            }
        }
        return $searchResult;
    }

    /**
     * @param $search
     * @return mixed
     * @throws \Exception
     */
    private  function getCacheSearch($search){
        return reGet(__METHOD__.md5($search),function () use ($search){
            return News::select(['title', 'slug', 'id', 'date', 'category_id', 'image'])->published()->whereTranslationLike("title", "%" . $search . "%")->paginate(10);
        });
    }

    /**
     * @param $keyword
     * @return Application|Factory|View
     * @throws Exception
     */
    public function doSearch($keyword){
        $results  = $this->buildSearch($keyword);
        if (count($results) <= 0) {
            return view("website.search", ['keyword' => $keyword, 'results' => $results, 'category' => null]);
        }
        SEO::setTitle($keyword);
        SEO::metatags()->addMeta('robots', 'index,follow');
        SEO::setCanonical(request()->fullUrl());
        SEO::opengraph()->addProperty('url', request()->url());
        SEO::setDescription(Str::limit($results[0]->description,config('seotools.lara_setting.description')));


        $category = reGet(__METHOD__ . '_cat_' . $keyword, function () use ($results) {
            if (count($results) > 0) {
                return $results[0]->category;
            }
            return Category::first();
        });
        return view("website.search", ['keyword' => $keyword, 'results' => $results, 'category' => $category]);
    }

}
