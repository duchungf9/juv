<?php

namespace App\FromSky\Admin\Decorators\AdminForm;


class StaticsComponent extends InputComponent
{
    function render($key, $value, $locale = '')
    {
        return "<div><i>" . strip_tags($value, '<br>') . "</i></div>";
    }
}