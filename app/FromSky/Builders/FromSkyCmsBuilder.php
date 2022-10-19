<?php

namespace App\FromSky\Builders;

use Illuminate\Database\Eloquent\Builder;


/**
 *
 */
class FromSkyCmsBuilder extends Builder
{

    /**
     * @param $status
     * @return FromSkyCmsBuilder.\App\FromSky\Builders\FromSkyCmsBuilder.where
     */
    public function status($status): FromSkyCmsBuilder
    {
        return $this->where('is_active', $status);
    }


    /**
     * @return FromSkyCmsBuilder
     */
    public function active(): FromSkyCmsBuilder
    {
        return $this->status(1);
    }


    /**
     * @return FromSkyCmsBuilder
     */
    public function inactive(): FromSkyCmsBuilder
    {
        return $this->where('is_active', '!=', 1)->orWhereNull('is_active');
    }


    /**
     * @return FromSkyCmsBuilder
     */
    public function published(): FromSkyCmsBuilder
    {
        return $this->where('pub', 1);
    }


    /**
     * @param        $slug
     * @param string $locale
     * @return mixed
     */
    public function findBySlug($slug, string $locale = ''): mixed
    {
        if (isset($this->model->translatedAttributes) && $this->model->isAttributeTranslatable('slug')) {return $this->model->getByTranslationSlug($slug, $locale);}
        return $this->model->where('slug', '=', $slug)->first();
    }


    /**
     * @param string $order
     * @param string $field
     * @return FromSkyCmsBuilder
     */
    public function sorted(string $order = "ASC", string $field = "sort"): FromSkyCmsBuilder
    {
        return $this->published()->orderBy($field, $order);
    }


    /**
     * @param string $order
     * @param string $field
     * @return FromSkyCmsBuilder
     */
    public function listed(string $order = "ASC", string $field = "sort"): FromSkyCmsBuilder
    {
        return $this->active()->orderBy($field, $order);
    }
}
