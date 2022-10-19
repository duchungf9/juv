<?php


namespace App\FromSky\Admin\Helpers;


use Illuminate\Support\Str;

/**
 * Trait AdminFormContext
 * @package App\FromSky\Admin\Helpers
 */
trait AdminFormContext
{
    /**
     * @var null
     */
    protected $context = null;

    /**
     * @param $context
     * @return $this
     */
    public function context($context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @param $key
     * @param $property
     * @return bool|void
     */
    function handleContext($key, $property)
    {
        if (Str::startsWith($key, 'seo') == $this->showSeo && data_get($property, 'context', null) == $this->context) {
            return true;
        }
    }
}