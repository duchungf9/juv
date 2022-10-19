<?php

namespace App\FromSky\Admin\Decorators;


use Carbon\Carbon;

class  AdminListDateComponent extends AdminListComponent
{

    public function render()
    {
        return Carbon::parse($this->getValue())->format('d/m/Y');;
    }
}

