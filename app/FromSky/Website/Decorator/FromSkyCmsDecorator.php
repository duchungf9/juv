<?php
/**
 * Created by PhpStorm.
 * User: web01
 * Date: 05/08/16
 * Time: 11:22
 */

namespace App\FromSky\Website\Decorator;

class FromSkyCmsDecorator
{
    protected $html;
    protected $model;
    protected $property;

    /**
     * @return mixed
     */
    public function render()
    {
        return $this->html;
    }
}