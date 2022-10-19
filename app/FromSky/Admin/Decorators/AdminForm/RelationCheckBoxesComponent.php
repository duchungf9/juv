<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use App\FromSky\Admin\Helpers\AdminFormRelation;


/**
 * Class RelationCheckBoxesComponent
 * @package App\FromSky\Admin
 */
class RelationCheckBoxesComponent extends SelectBaseComponent
{

    use AdminFormRelation;

    function render($key, $value)
    {
        $objRelation = $this->getRelation();
        $selected    = $this->model->{$this->property['relation_name']}->pluck('id')->toArray();
        return view('admin.inputs.checkboxes_grid', ['properties' => $this->property, 'objRelation' => $objRelation, 'selected' => $selected, 'key' => $key]);
    }

}
