<?php

namespace App\FromSky\DomainLayer\News;

use App\FromSky\Tools\StringHelper;
use Cache;

trait NewsPresenter
{

    /*
    |--------------------------------------------------------------------------
    |  This method return the news permalink.
    |--------------------------------------------------------------------------
    */
    public function getPermalink($locale = '')
    {
        $model = $this;
        return reGet(__METHOD__ . $this->id, function () use ($locale, $model) {
            $locale = ($locale) ? $locale : app()->getLocale();
            $cat    = $model->category;
            if (!is_null($cat)) {
                $catSlug = $cat->slug;
                if ($cat->parent_id > 0) {
                    $catSlug = $cat->parent->slug . '/' . $catSlug;
                }
            } else {
                $catSlug = '';
            }

            return url_locale($catSlug . '/' . $model->{'slug:' . $locale} . '.html');
        });
    }

    public function getTags()
    {
        $model = $this;
        return reGet(__METHOD__ . $this->id, function () use ($model) {
            return $model->tags;
        });
    }

    /*
    |--------------------------------------------------------------------------
    |  This method return the news excerpt.
    |--------------------------------------------------------------------------
    */
    public function getExcerpt($length = 150, $strip = true)
    {
        $description = ($strip) ? strip_tags(html_entity_decode($this->description)) : $this->description;
        return StringHelper::truncate($description, $length);
    }
}