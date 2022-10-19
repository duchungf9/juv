<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use Form;

class ReadonlyComponent extends InputComponent
{
    function render($key, $value, $locale = '')
    {
        $this->add_field_property('readonly', true);
        return Form::text($key, $value, $this->field_properties());
    }
}