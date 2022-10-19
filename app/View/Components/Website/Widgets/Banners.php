<?php

namespace App\View\Components\Website\Widgets;

use App\FromSky\Tools\ImgHelper;
use App\Model\Widget;
use Cache;
use Illuminate\View\Component;

/**
 *
 */
class Banners extends Component
{
    /**
     * @var null
     */
    /**
     * @var null
     */
    public $idBanner   = null;
    public $codeBanner = '';
    public $template   = "banner";
    public $width      = 250;
    public $height     = 250;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($idBanner = 0, $template = "banner", $codeBanner = '', $width = 250, $height = 250)
    {
        $this->idBanner   = $idBanner;
        $this->codeBanner = $codeBanner;
        $this->template   = $template;
        $this->width      = $width;
        $this->height     = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $idBanner   = $this->idBanner;
        $codeBanner = $this->codeBanner;
        $banner     = reGet(md5(__METHOD__ . $idBanner . $codeBanner), function () use ($idBanner, $codeBanner) {
            if (!empty($codeBanner)) {
                return Widget::whereCode($codeBanner)->active()->first();
            }
            return Widget::whereId($idBanner)->active()->first();
        });
        if (!is_null($banner)) {
            $idBanner = $banner->id;
        }
        if (is_null($banner) || $idBanner == 0) return view('components.website.widgets.defaut-banner');
        return view('components.website.widgets.' . $this->template, compact('banner'));
    }
}
