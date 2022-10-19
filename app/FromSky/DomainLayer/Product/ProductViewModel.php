<?php

namespace App\FromSky\DomainLayer\Product;

use App\Model\Product;
use App\FromSky\DomainLayer\Website\WebsiteViewModel;


class ProductViewModel extends WebsiteViewModel
{


    function show(string $slug)
    {
        $product = Product::findBySlug($slug, app()->getLocale());
        $page    = $this->getCurrentPage();
        // single product
        if ($product) {
            $category    = $product->category;
            $locale_page = $product;
            $this->setSeo($product);
            return view('website.product', compact('page', 'product', 'category', 'locale_page'));
        }
        return $this->handleMissingPage();
    }
}