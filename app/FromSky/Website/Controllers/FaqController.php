<?php

namespace App\FromSky\Website\Controllers;


use App\FromSky\DomainLayer\Faq\FaqViewModel;


/**
 *
 */
class FaqController extends PagesController
{
    function index(string $slug = '')
    {
        return (new FaqViewModel('faq'))->handle($slug);
    }
}
