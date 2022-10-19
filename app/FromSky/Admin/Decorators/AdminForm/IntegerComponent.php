<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use Form;

/**
 * Class IntegerComponent
 * @package App\FromSky\Admin\Decorators\AdminForm
 */
class IntegerComponent extends InputComponent
{
    function render($key, $value, $locale = '')
    {
        $this->property['extra_field_properties'] = [
            'min'  => data_get($this->property, 'min'),
            'max'  => data_get($this->property, 'min'),
            'step' => data_get($this->property, 'step'),
        ];
        $this->setDefault();
        return Form::number($key, $value, $this->field_properties());
    }

    // number input need to have the min, max and step
    // attributes. Attributes  can be empty
    // if you don't need a range
    function setDefault()
    {

        if (!$this->property->has('extra_field_properties')) {
            $this->property['extra_field_properties'] = [
                'min'  => '',
                'max'  => '',
                'step' => "2"
            ];
        }
    }
}