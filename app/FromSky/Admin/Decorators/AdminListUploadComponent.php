<?php


namespace App\FromSky\Admin\Decorators;


class AdminListUploadComponent extends AdminListComponent
{

    public function render()
    {
        return $this->component();
    }

    protected function component()
    {
        if ($this->getValue() == '') return "";
        $media = $this;
        return view('admin.list.document', compact('media'));
    }

}