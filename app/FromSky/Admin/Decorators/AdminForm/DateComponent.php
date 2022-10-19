<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use Carbon\Carbon;
use Form;


class DateComponent extends InputComponent
{
    function render($key, $value, $locale = '')
    {
        $date = $this->getValue($value);
        return Form::text($key, $date, $this->field_properties());
    }

    function getValue($value)
    {
        return ($value) ? Carbon::parse($value)->format('Y-m-d H:i:s') : date('Y-m-d H:i:s');
    }
}