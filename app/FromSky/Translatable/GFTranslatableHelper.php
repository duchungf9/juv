<?php namespace App\FromSky\Translatable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Cache;

/*
|--------------------------------------------------------------------------
|  Helper and override function for laravel-translatable
|--------------------------------------------------------------------------
|
|
*/

/**
 * Trait GFTranslatableHelperTrait
 * @package App\FromSky\Translatable
 */
trait GFTranslatableHelper
{



    /*
       |--------------------------------------------------------------------------
       |  Translate helper
       |--------------------------------------------------------------------------
   */

    /**
     * @param Builder $query
     * @param $key
     * @param $value
     * @param null $locale
     * @return Builder
     */
    public function scopeTranslation(Builder $query, $key, $value, $locale = null)
    {
        return $query->whereHas('translations', function (Builder $query) use ($key, $value, $locale) {
            $query->where($this->getTranslationsTable() . '.' . $key, 'LIKE', $value);
            if ($locale) {
                $query->where($this->getTranslationsTable() . '.' . $this->getLocaleKey(), '=', $locale);
            }
        });
    }

    /**
     * @param Builder $query
     * @param $sorta
     * @param $sortaType
     * @param $locale
     * @return Builder
     */
    public function scopeTranslationOrderable(Builder $query, $sorta, $sortaType, $locale)
    {
        return $query->join($this->getTranslationsTable() . ' as  t', 't.' . $this->getRelationKey(), '=', $this->getTable() . '.id')
            ->where('t.' . $this->getLocaleKey(), '=', $locale)
            ->groupBy($this->getTable() . '.id')
            ->orderBy("t." . $sorta, $sortaType)
            ->with('translations');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeTranslatedContent(Builder $query)
    {
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale())->where('title', '!=', '');
        });
    }

    /**
     * @param $slug
     * @param string $locale
     * @return mixed
     */
    public static function getByTranslationSlug($slug, $locale = '')
    {
        if(config('translatable.use_fallback')){
            return self::WhereTranslation('slug', $slug, $locale)->orWhereTranslation('slug', $slug, config('translatable.locale'))->first();
        }
        return self::WhereTranslation('slug', $slug, $locale)->first();
    }


    /**
     * @param $key
     * @return bool
     */
    public function isAttributeTranslatable($key)
    {
        return (property_exists($this, 'translatedAttributes') && in_array($key, $this->translatedAttributes));
    }

    /**
     * @return array
     */
    public function getTranslatablesAttribute()
    {
        $this->translatables = [];
        foreach (config('app.locales') as $locale => $value) {
            foreach ($this->translatedAttributes as $attribute) {
                $attribute_key = $attribute . "_" . $locale;
                //set optional if translation is missing
                $this->translatables[$attribute_key] = optional($this->translate($locale))->{$attribute};
            }
        }
        return $this->translatables;
    }
}
