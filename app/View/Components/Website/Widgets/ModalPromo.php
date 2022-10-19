<?php

namespace App\View\Components\Website\Widgets;

use App\View\Components\Website\Ui\Modal;
use App\Model\Widget;

class ModalPromo extends Modal
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->withName('modal-promo');
        $this->widget = $this->componentName;
        $this->model = Widget::firstWhere('code',$this->widget);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.website.widgets.modal-promo');
    }
}
