<?php

namespace App\FromSky\Builders;

use App\Model\News;
use Carbon\Carbon;

/**
 *
 */
class TemplateBuilder extends FromSkyCmsBuilder
{

    /**
     * @param $template
     * @return FromSkyCmsBuilder|m
     */
    public function byTemplate($template)
    {
        return $this->where('template', $template)->published();
    }


}
