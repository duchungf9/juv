<?php


namespace App\FromSky\DomainLayer\Store\Controllers;


use App\Model\Page;
use App\Http\Controllers\Controller;
use App\FromSky\DomainLayer\Store\Facades\StoreHelper;
use App\Model\Order;
use \App\FromSky\SeoTools\fromSkyCmsSeoTrait;

class OrderControllers extends Controller
{
    use fromSkyCmsSeoTrait;

    function index()
    {
        $page = $this->getPage('dashboard');
        return view('fromsky_store::order.index', compact('page'));
    }

    public function show(Order $order)
    {
        $page = $this->getPage('dashboard');
        $this->setSeo($order);
        return view('fromsky_store::order.detail', compact('page', 'order'));
    }

    function getPage($slug)
    {
        return Page::findBySlug($slug, app()->getLocale());
    }
}
