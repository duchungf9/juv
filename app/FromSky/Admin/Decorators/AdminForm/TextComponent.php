<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use Form;

class TextComponent extends InputComponent
{
    function render($key, $value, $locale = '')
    {
        $height = 'height:' . data_get($this->property, 'h', '300') . 'px';
        $this->extra_field_properties();
        return Form::textarea($key, $value . '', $this->field_properties());
    }
}