<?php

namespace App\View\Components\Website\Partials;

use App\FromSky\Tools\SettingHelper;
use App\Model\Setting;
use App\Model\Widget;
use Illuminate\View\Component;

class Header extends Component
{
    private $idWidget = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idWidget)
    {
        $this->idWidget = $idWidget;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.website.partials.header',[
            'banner'=>$this->banner()
        ]);
    }

    public function banner(){
        return reGet(__METHOD__.$this->idWidget,function (){
            return Widget::find($this->idWidget);
        });
    }

}
