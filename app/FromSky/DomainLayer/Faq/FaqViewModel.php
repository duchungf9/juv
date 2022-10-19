<?php

namespace App\FromSky\DomainLayer\Faq;


use App\Model\Faq;
use App\FromSky\DomainLayer\Website\WebsiteViewModel;

/**
 * Class FaqViewModel
 * @package App\FromSky\DomainLayer\Faq
 */
class FaqViewModel extends WebsiteViewModel
{

    function index()
    {
        $page = $this->getCurrentPage();
        $faqs = Faq::sorted()->get();// get active and sorted by sort ASC order
        $this->setSeo($page);
        return view('website.faq.index', compact('page', 'faqs'));
    }
}