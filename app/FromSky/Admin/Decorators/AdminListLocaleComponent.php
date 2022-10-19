<?php


namespace App\FromSky\Admin\Decorators;


class  AdminListLocaleComponent extends AdminListComponent
{

    public function render()
    {
        $value = $this->getValue();
        return "<img class=\"flag\" 
                     src=\"" . asset(config('fromSky.admin.path.assets') . "website/images/flags/" . $value . ".png") . "\" 
                     alt=\"" . $value . " flag\">";
    }
}

