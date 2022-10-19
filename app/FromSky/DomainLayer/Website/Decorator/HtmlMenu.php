<?php

namespace App\FromSky\DomainLayer\Website\Decorator;

use App\FromSky\DomainLayer\Store\Facades\StoreFeatures;
use Auth;
use Cache;
use LaravelLocalization;
use App\FromSky\Website\Decorator\FromSkyCmsDecorator;
use App\Model\Page;
use App\Model\Social;

/**
 * Class HtmlMenu
 * @package App\FromSky\Website\Decorator
 */
class HtmlMenu extends FromSkyCmsDecorator
{
    /**
     * This method is used to get the pages links html.
     */
    public static function getPageLinks($current_page, $prefix = '')
    {
        return reGet('menuItems'.$current_page.$prefix, function () use ($current_page, $prefix) {
            $menu = Page::menuItems()->get();
            $html = '';
            $top  = $menu->filter(function ($item) {
                return data_get($item, 'parent_id') <= 0 || data_get($item, 'parent_id') == null;
            })->all();
            slog('menuItems'.$prefix);
            foreach ($top as $index => $page) {
                $children = $menu->where('parent_id', $page->id);
                $active   = (!empty($current_page) && ($current_page->id == $page->id || $current_page->parent_id == $page->id)) ? 'active' : '';

                if (optional($children)->count() > 0) {
                    $html .= view('website.navbar.dropdown' . $prefix, compact('page', 'children', 'active'));
                } else {
                    $html .= view('website.navbar.item' . $prefix, compact('page', 'active'));
                }
            }
            return $html;
        });
    }


    /**
     * This method is used to get the auth links html.
     */
    public static function getAuthLinks()
    {
        return view('website.navbar.auth');
    }

    /**
     * This method is used to get the store links html.
     */
    public static function getStoreLinks()
    {
        if (StoreFeatures::isStoreEnabled()) {
            return view('website.navbar.store');
        }
    }

    /**
     * This method is used to get the language selector html.
     */
    public static function getLanguageSelector($locale_page)
    {
        if (count(LaravelLocalization::getSupportedLocales()) > 1) {
            return view('website.navbar.language_selector', compact('locale_page'));
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function getSocial()
    {
        $socials = Social::published()->orderBy('sort')->get();
        return view('website.navbar.social', compact('socials'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function getBeforeNavbar()
    {
        return view('website.navbar.before');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function getAfterNavbar()
    {
        return view('website.navbar.after');
    }

}
