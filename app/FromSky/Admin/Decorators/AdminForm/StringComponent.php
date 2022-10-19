<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use Form;

class StringComponent extends InputComponent
{
    function render($key, $value, $locale = '')
    {
        return Form::text($key, strip_tags($value, '<br>'), $this->field_properties());
    }
}