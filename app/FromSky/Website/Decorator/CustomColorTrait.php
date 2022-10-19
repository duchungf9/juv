<?php

namespace App\FromSky\Website\Decorator;

trait CustomColorTrait
{
    // override default bg color
    public function getBreadcrumbColorAttribute()
    {
        return ($this->color)
            ? 'background-color:' . $this->color
            : "";
    }
}