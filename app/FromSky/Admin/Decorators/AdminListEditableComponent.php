<?php

namespace App\FromSky\Admin\Decorators;


class  AdminListEditableComponent extends AdminListComponent
{

    public function render()
    {
        return $this->component();
    }

    protected function component()
    {
        $item = $this;
        return view('admin.list.input', compact('item'));
    }
}
