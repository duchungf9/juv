<?php

namespace App\FromSky\Admin\Decorators\AdminForm;


use App\FromSky\Admin\Helpers\AdminFormRelation;
use App\FromSky\Admin\Helpers\AdminTree;

/**
 * RelationSetSelectComponent
 * @package App\FromSky\Admin
 */
class RelationSetSelectComponent extends SelectBaseComponent
{
    use AdminFormRelation;

    function render($key, $value)
    {
        $this->value = $value;
        $this->selected();
        $objRelation     = $this->getRelation();
        $objRelationTree = (new AdminTree($this->formObject))->getTreeRelation($objRelation, 0);
        return (new SelectBaseComponent($this->formObject))->get($objRelationTree, $key, $value, $this->selected);
    }

    function selected()
    {
        return $this->selected = ($this->value != '') ? explode(',', $this->value) : '';
    }
}
