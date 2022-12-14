<?php

namespace App\FromSky\Website\Decorator;

use App;
use App\Model\Social;
use Carbon\Carbon;

/**
 * Class HtmlSocial
 * @package App\FromSky\Website\Decorator
 */
class HtmlSocial extends FromSkyCmsDecorator
{

    /**
     * @var
     */
    protected $html;
    /**
     * @var
     */
    protected $model;
    /**
     * @var
     */
    protected $property;

    /**
     * @return $this
     */
    public function get()
    {
        $this->initHtml();
        $this->createSocialBar();
        return $this;
    }

    /**
     * init
     */
    protected function initHtml()
    {
        $this->html  = "";
        $this->model = new App\Model\Social;
    }

    /**
     * create Social Html
     */
    function createSocialBar()
    {
        foreach ($this->model->sorted()->get() as $item) {
            $this->html .= '<li>';
            if (filter_var($item->link, FILTER_VALIDATE_EMAIL)) {
                $this->html .= '<a href="mailto:' . $item->link . '">';
            } else {
                $this->html .= '<a href="' . $item->link . '" target="_blank">';
            }

            $this->html .= '<span class="fa-stack">';
            $this->html .= '<i class="fa fa-circle fa-stack-2x"></i>';
            $this->html .= '<i class="fab fa-' . $item->icon . ' fa-stack-1x fa-inverse"></i>';
            $this->html .= '</span>';

            $this->html .= '</a>';
            $this->html .= '</li>';
        }
    }
}
