<?php

namespace App\FromSky\Admin\Decorators\AdminForm;


use App\FromSky\Admin\Helpers\AdminFormRelation;


/**
 * Class RelationSelectComponent
 * @package App\FromSky\Admin
 */
class RelationSelectComponent extends SelectBaseComponent
{
    use AdminFormRelation;

    function render($key, $value)
    {
        $this->selected();
        $objRelation = $this->getRelation($this->selected);
        return (new SelectBaseComponent($this->formObject))->get($objRelation, $key, $value, $this->selected);
    }
}
