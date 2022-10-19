<?php

namespace App\FromSky\Website\Controllers;


use App\Http\Controllers\Controller;

use App\FromSky\DomainLayer\Product\ProductViewModel;
use App\FromSky\DomainLayer\Category\CategoryViewModel;


/**
 * Class ProductsController
 * @package App\FromSky\Website\Controllers
 */
class ProductsController extends Controller
{

    public function category(string $category_slug = '')
    {
        $slug = $this->resolvePageSlug();
        return (new CategoryViewModel($slug))->handle($category_slug);
    }


    public function products(string $category_slug, string $product_slug)
    {
        $slug = $this->resolvePageSlug();
        return (new ProductViewModel($slug))->handle($product_slug);
    }

    function resolvePageSlug()
    {
        $segments = request()->segments();
        return end($segments);
    }
}
