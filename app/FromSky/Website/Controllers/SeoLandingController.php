<?php

namespace App\FromSky\Website\Controllers;

use App\FromSky\Website\Repos\Page\PageRepositoryInterface;
use App\Http\Controllers\Controller;
use Input;
use Validator;

use App\Model\Province;
use App\FromSky\SeoTools\SeoLandingHelper;
use \App\FromSky\SeoTools\fromSkyCmsSeoTrait;

class SeoLandingController extends Controller
{
    use fromSkyCmsSeoTrait;

    /**
     * @var
     */
    protected $template;
    /**
     * @var PageRepositoryInterface
     */
    protected $articleRepo;

    /**
     * @param PageRepositoryInterface $page
     */

    public function __construct(PageRepositoryInterface $page)
    {
        $this->articleRepo = $page;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productByCity($product, $city)
    {
        $setting = 'product-by-city';
        $page    = $this->articleRepo->getBySlug($setting);

        if (!$page) {
            return redirect()->to(url_locale('/'));
        }

        $province = Province::where('slug', $city)->first();
        $product  = config('fromSky.website.seolanding.' . $setting . '.product.' . $product);
        $city     = config('fromSky.website.seolanding.' . $setting . '.city.' . $city);

        if (!$city || !$product || !$province) {
            return redirect()->to(url_locale('/'));
        }

        $page->title           = SeoLandingHelper::replaceTags($page->title, compact('product', 'city'));
        $page->subtitle        = SeoLandingHelper::replaceTags($page->subtitle, compact('product', 'city'));
        $page->description     = SeoLandingHelper::replaceTags($page->description, compact('product', 'city'));
        $page->seo_title       = SeoLandingHelper::replaceTags($page->seo_title, compact('product', 'city'));
        $page->seo_description = SeoLandingHelper::replaceTags($page->seo_description, compact('product', 'city'));

        $this->setSeo($page);

        return view('website.seo.product-by-city', compact('page', 'product', 'city', 'province'));
    }
}
