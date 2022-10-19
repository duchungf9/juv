<?php

namespace App\FromSky\Admin\Decorators;

class AdminListRelationImageComponent extends AdminListImageComponent
{
    public function getValue()
    {
        return $this->value = ($this->model->{$this->getItemProperty('relation')}) ? $this->model->{$this->getItemProperty('relation')}->{$this->getField()} : '';
    }
}
