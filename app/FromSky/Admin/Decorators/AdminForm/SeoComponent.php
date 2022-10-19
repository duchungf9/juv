<?php

namespace App\FromSky\Admin\Decorators\AdminForm;


/**
 * Abstract base class for seo component
 * Class SeoComponent
 * @package App\FromSky\Admin\Decorators\AdminForm
 */
abstract class SeoComponent extends InputComponent
{
    /**
     * @param $default
     * @return mixed
     */
    function getMaxWordCount($default)
    {
        return data_get($this->property, 'max', $default);
    }
}