<?php


namespace App\FromSky\Admin\Decorators;


/**
 * Simple  class to render generic view list component
 *
 * Class AdminListViewComponent
 * @package App\FromSky\Admin\Decorators
 */
class  AdminListViewComponent extends AdminListComponent
{

    public function render()
    {
        return $this->component();
    }
}