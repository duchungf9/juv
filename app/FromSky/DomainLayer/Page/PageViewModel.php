<?php

namespace App\FromSky\DomainLayer\Page;


use App\Model\Category;
use Illuminate\View\View;

use App\FromSky\DomainLayer\Website\WebsiteViewModel;


/**
 *
 */
class PageViewModel extends WebsiteViewModel
{

    function index(): View
    {
        $page = $this->getPage('home');
        $this->setSeo($page);
        $template = $this->handleTemplate($page);
        return view($template, compact('page'));
    }

    function intro(): View
    {
        $page = $this->getPage('home');
        $this->setSeo($page);
        return view('website.home', compact('page'));
    }

    function show(string $parent, string $child = '')
    {
        $page = (!$child) ? $this->getParentPage($parent, app()->getLocale()) : $this->getSubPage($parent, $child);
        if ($this->validatePage($page)) {
            $this->setSeo($page);
            $template = $this->handleTemplate($page);
            return view($template, compact('page'));
        }
        return $this->handleMissingPage();
    }


    protected function getParentPage($parent)
    {

        $page = $this->getPage($parent, app()->getLocale());
        // Return false if page has parented because this method is used only for parent page
        return ($page && $page->parent_id != 0) ? false : $page;

    }

    public function getSubPage(string $parent, string $child)
    {
        $parent = $this->getPage($parent);
        $child  = $this->getPage($child);
        // If $parent or $child doesn't exists
        if (!$parent || !$child) {
            return false;
        }

        // If $parent and $child doesn't match
        if ($parent->id != $child->parent_id) {
            return false;
        }

        // Return $child data
        return $child;
    }

    function handleTemplate($page): string
    {
        // Get website default locale
        $fallback_locale = \Config::get('app.fallback_locale');
        $template        = ($page->template_id) ? $page->template->value : $page->{'slug:' . $fallback_locale};
        return (view()->exists('website.' . $template)) ? 'website.' . $template : 'website.normal';
    }

    /**
     * @param $page
     * @return bool
     */
    function validatePage($page): bool
    {
        return $page && $page->slug != 'home' && $page->pub == 1;
    }

    /**
     * Quản lý sẽ được gọi ở PageController để tìm vào quản lý vào trang nào
     *
     * @param [type] $page
     * @return string
     */
    function handle($parent, $child = '')
    {
        if ($parent == 'home') return $this->index();
        if ($parent == 'intro') return $this->intro();
        return $this->show($parent, $child);
    }
}
