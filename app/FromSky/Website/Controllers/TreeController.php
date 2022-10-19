<?php

namespace App\FromSky\Website\Controllers;

use App\Model\Page;
use App\Http\Controllers\Controller;
use App\FromSky\Admin\Decorators\TreeDecorator;


class TreeController extends Controller
{

    function index()
    {
        $pages = Page::orderBy('sort')->get();
        return view('website/tree/tree', compact('pages'));
    }

}
