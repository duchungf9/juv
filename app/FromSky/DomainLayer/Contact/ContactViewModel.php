<?php

namespace App\FromSky\DomainLayer\Contact;

use App\Http\Resources\MapLocationResource;
use App\Model\Location;
use App\FromSky\DomainLayer\Website\WebsiteViewModel;
use App\Model\Product;
use Illuminate\View\View;

class ContactViewModel extends WebsiteViewModel
{
    function show(): View
    {
        $page = $this->getPage(trans('routes.contacts'));
        $this->setSeo($page);
        $parameter = request()->get('product_id');

        $locations = MapLocationResource::collection(Location::query()->wherePub(1)->get());

        if ($parameter && !is_array($parameter)) {
            $product = Product::findOrFail($parameter);
            return view('website.contacts', ['product' => $product, 'page' => $page, 'locations' => $locations]);
        }

        return view('website.contacts', ['page' => $page, 'locations' => $locations]);
    }
}