<?php

namespace App\FromSky\Admin;

use Form;
use App;

use App\FromSky\Admin\Helpers\AdminFormRelation;

/**
 * Class AdminFormImageRelation
 * @package App\FromSky\Admin
 */
class AdminFormImageRelation
{

    use AdminFormRelation;

    /**
     * @var
     */
    protected $property;
    /**
     * @var
     */
    protected $a;
    /**
     * @var
     */
    protected $field;
    /**
     * @var string
     */
    protected $image_field = "image";
    /**
     * @var
     */
    protected $selectedItem;

    /**
     * @param $property
     * @return $this
     */
    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * @param $field
     * @param string $selItem
     * @return string
     */
    public function get($field, $selItem = '')
    {
        $obj                = $this->getRelation();
        $this->field        = $field;
        $this->selectedItem = $selItem;
        $this->a            = (isset($this->property['foreign_key'])) ? $this->property['foreign_key'] : 'id';
        $this->image_field  = (isset($this->property['image_field'])) ? $this->property['image_field'] : $this->image_field;

        $html = "<div class=\"row row-semi-condensed\">";
        $html .= "<input type=\"hidden\" value='" . $this->selectedItem . "' name=\"" . $this->field . "\" id=\"" . $this->field . "\">";
        $html .= $this->getSelectedImage($obj);
        $html .= $this->getImageList($obj);
        $html .= "</div>";

        return $html;
    }


    /**
     * @param $obj
     * @return string
     */
    protected function getSelectedImage($obj)
    {
        $html = "";
        foreach ($obj as $item) {
            if ($item->{$this->a} == $this->selectedItem) $html .= $this->getHtmlImage($item, "active");
        }
        return $html;
    }

    /**
     * @param $obj
     * @return string
     */
    protected function getImageList($obj)
    {
        $html = "";
        foreach ($obj as $item) {
            if ($item->{$this->a} != $this->selectedItem) $html .= $this->getHtmlImage($item);
        }
        return $html;
    }

    /**
     * @param $item
     * @param string $class
     * @return string
     */
    protected function getHtmlImage($item, $class = "inactive")
    {

        $relationModel = "App\\Model\\" . $this->property['model'];
        $objMedia      = $relationModel::find($item->{$this->a});
        $html          = "<div class=\"col-4 col-md-2\"><a href=\"#\"
                     data-image-relation=\"" . $this->field . "\"  data-image-id =\"" . $item->{$this->a} . "\" class=\"thumbnail " . $class . "\">";
        $html          .= "<img src=\"" . ma_get_image_from_repository($objMedia->image) . "\" alt=\"" . $item->title . "\" class='img-fluid'>";
        $html          .= "</a></div>";
        return $html;
    }
}
