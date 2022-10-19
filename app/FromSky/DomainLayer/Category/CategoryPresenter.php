<?php

namespace App\FromSky\DomainLayer\Category;

use Cache;

trait CategoryPresenter

{
    /*
    |--------------------------------------------------------------------------
    |  Seo & Meta
    |--------------------------------------------------------------------------
    */
//    function getFullSlug($locale = '')
//    {
//        /** @var  JSP  trick */
//        $locale = ($locale) ?: app()->getLocale();
//        return preg_replace('/\{category\??\}/', $this->{'slug:' . $locale}, trans('routes.category', array(), $locale));
//    }


    public function getFullSlug($cat, $locale = ''): array|string|null
    {
        $locale = ($locale) ?: app()->getLocale();
        return $cat->{'slug:' . $locale};
//        return preg_replace('/\{category\??\}/', $cat->{'slug:' . $locale}, trans('routes.category', array(), $locale));
    }

    public function buildSlug($cat, $locale = ''): string
    {
        $url = ($cat->parent_id > 0) ? ($cat->buildSlug($this->parent, $locale) . "/") : "";
        return $url . $this->getFullSlug($cat, $locale);
    }

    /**
     * @param string $locale
     * @return false|string
     */
    public function getPermalink(string $locale = ''): bool|string
    {
        $model = $this;
        return reGet('getPermalinkCat' . $this->id, function () use ($locale, $model) {
            return url_locale($model->buildSlug($model, $locale));
        });

    }

    function getNavTitleAttribute()
    {
        return ($this->menu_title) ? $this->menu_title : $this->title;
    }

    function getNavLinkAttribute()
    {
        return $page_link = ($this->link) ? $this->link : $this->getPermalink();
    }
}
