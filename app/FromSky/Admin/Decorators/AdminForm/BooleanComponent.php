<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use Form;

/**
 * Base input class
 * Class InputComponent
 * @package App\FromSky\Admin\Decorators\AdminForm
 */
class BooleanComponent extends InputComponent
{
    function render($key, $value, $locale = '')
    {
        return (new CheckBox($this->formObject))->render($value, $key);
    }
}