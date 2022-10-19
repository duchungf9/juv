<?php

namespace App\FromSky\Admin\Decorators\AdminForm;


use App\FromSky\Admin\Helpers\AdminFormRelation;
use App\FromSky\Admin\Helpers\AdminTree;


/**
 * Class RelationTreeComponent
 * @package App\FromSky\Admin
 */
class RelationTreeComponent extends SelectBaseComponent
{

    use AdminFormRelation;

    function render($key, $value)
    {
        $this->selected();
        $objRelation     = $this->getRelation();
        $objRelationTree = (new AdminTree($this->formObject))->getTreeRelation($objRelation, 0);
        return (new SelectBaseComponent($this->formObject))->get($objRelationTree, $key, $value, $this->selected);
    }
}
