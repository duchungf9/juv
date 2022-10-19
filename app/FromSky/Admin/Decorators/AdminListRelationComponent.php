<?php

namespace App\FromSky\Admin\Decorators;

class AdminListRelationComponent extends AdminListComponent
{
    public $relationObj;

    public function render()
    {
        return $this->component();
    }

    protected function component()
    {
        if ($this->isEditable()) {
            $this->relationObj = (new AdminDecorator)->getRelation($this->item);
            $item              = $this;
            $this->html        = view('admin.list.select', compact('item'));
            return $this->html;
        }
        return $this->getRelationValue();
    }


    function getRelationValue()
    {

        $relation = $this->getItemProperty('relation');
        if ($this->getItemProperty('multiple') != '') {
            $data = optional($this->model->$relation)->pluck($this->getField())->sortBy($this->getField())->toArray();
//            return $this->value = '<span class="badge rounded-pill bg-info me-2">'.implode('</span><span class="badge rounded-pill bg-info me-2"> ', $data).'</span';
            return $this->value = view('components.admin.lists.has-many-relation', compact('data'));
        }
        $fieldShow = $this->item['field_readonly']??$this->getField();
        return $this->value = optional($this->model->$relation)->{$fieldShow};
    }
}
