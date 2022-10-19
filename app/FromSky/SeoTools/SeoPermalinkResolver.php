<?php


namespace App\FromSky\SeoTools;


use Illuminate\Support\Str;

trait SeoPermalinkResolver
{
    function getFullSlug($locale = '')
    {
        /** @var  JSP  trick */
        $model_name = $this->resolveRouteName();
        $locale     = ($locale) ?: app()->getLocale();
        $trans_url  = trans('routes.' . Str::plural($model_name), array(), $locale);
        if ($this->category != null) {
            $trans_url = str_replace('{category}', $this->category->{'slug:' . $locale}, $trans_url);
        }
        $trans_url = preg_replace('/\{' . $model_name . '\??\}/', $this->{'slug:' . $locale}, $trans_url);
        return $trans_url;
    }

    function resolveRouteName()
    {
        return strtolower(class_basename($this));
    }

    public function makePermalink($locale = '')
    {
        $locale = ($locale) ? $locale : get_locale();
        $this->translate($locale)->update(['permalink' => $this->getFullSlug($locale)]);
//        $this->save();
    }

    public function getPermalink($locale = '')
    {
        $permalink = $this->{'permalink:' . $locale};
        if (!$permalink) {
            $this->makePermalink($locale);
            $permalink = $this->{'permalink:' . $locale};
        }
        return url_locale($permalink);
    }
}