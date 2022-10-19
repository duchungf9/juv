<?php

namespace App\FromSky\DomainLayer\Location;

use App\Model\Location;
use App\FromSky\DomainLayer\Website\WebsiteViewModel;
use App\Model\Tag;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Collection;

class LocationViewModel extends WebsiteViewModel
{

    function index()
    {
        $page      = $this->getCurrentPage();
        $locations = Location::published()->orderBy('sort')->get();
        $this->setSeo($page);
        return view('website.location.index', ['page' => $page, 'locations' => $locations]);
    }

    function show(string $slug)
    {
        $location  = Location::findBySlug($slug, app()->getLocale());
        $locations = collect(Location::published()->orderBy('sort')->pluck('id'));
        $curItem   = array_search($location->id, $locations->toArray());
        $nextId    = (isset($locations[$curItem + 1])) ? $locations[$curItem + 1] : $locations->first();
        $prevId    = (isset($locations[$curItem - 1])) ? $locations[$curItem - 1] : $locations->last();
        $next      = Location::find($nextId);
        $prev      = Location::find($prevId);

        $page = $this->getCurrentPage();
        $this->setSeo($location);
        $locale_page = $location;

        return view('website.location.single', compact('page', 'location', 'locale_page', 'next', 'prev'));

    }
}