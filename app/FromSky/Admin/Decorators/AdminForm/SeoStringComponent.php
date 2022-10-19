<?php

namespace App\FromSky\Admin\Decorators\AdminForm;


/**
 * Class SeoStringComponent
 * @package App\FromSky\Admin\Decorators\AdminForm
 */
class SeoStringComponent extends SeoComponent
{

    function render($key, $value = '', $locale = '')
    {
        return '<seo-input-component 
                   max-count="' . $this->getMaxWordCount(config('seotools.lara_setting.title')) . '" 
                   name="' . $key . '" 
                   input_text="' . $value . '">
               </seo-input-component>';
    }
}