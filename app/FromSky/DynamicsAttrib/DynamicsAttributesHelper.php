<?php namespace App\FromSky\Translatable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Cache;

/*
|--------------------------------------------------------------------------
|  Helper and override function for DynamicsAttributesHelper
|--------------------------------------------------------------------------
|
|
*/

/**
 * Trait GFTranslatableHelperTrait
 * @package App\FromSky\Translatable
 */
trait DynamicsAttributesHelper
{


    /*
     |--------------------------------------------------------------------------
     |  Attributes Helpers
     |--------------------------------------------------------------------------
 */

    /**
     * @return string
     */
    public function getModelClassBaseName()
    {
        return class_basename($this);
    }

    public function getModelClassBaseNameLower()
    {
        return strtolower($this->getModelClassBaseName());
    }

    /**
     * @return string
     */
    public function getModelClassAttributes()
    {
        return $this->getModelClassBaseName() . 'Attributes';
    }

    /**
     * @return string
     */
    public function getModelNameSpaceAttributes()
    {
        return 'App\\Model\\' . $this->getModelClassAttributes();
    }

    public function getModelNameSpaceAttributesValue()
    {
        return $this->getModelNameSpaceAttributes() . 'Value';
    }

    /**
     * @return string
     */
    public function getModelClassNameSnake()
    {
        return getNameSnake($this->getModelClassBaseName());
    }

    /**
     * @param $field
     * @param $id
     * @return string
     */
    public function fieldToDynamicsInputName($field, $id)
    {
        return 'dynamicsAttr-' . $field . '-' . $id;
    }

    /**
     * @param $inputName
     * @return \stdClass
     */
    public function dynamicsInputNameToField($inputName)
    {
        $partDynamics = explode('-', $inputName);
        /**
         * @property $dynamicField
         * @property $dynamicId
         */
        $obj               = new \stdClass();
        $obj->dynamicField = $partDynamics[1];
        $obj->dynamicId    = $partDynamics[2];
        return $obj;
    }

    /**
     * @return string
     */
    public function getIdNameModel()
    {
        return $this->getModelClassNameSnake() . '_id';
    }

    /**
     * @return string
     */
    public function getIdNameDynamicsAttr()
    {
        return $this->getModelClassNameSnake() . '_attributes_id';
    }

    public function getIdNameDynamicsAttrValue()
    {
        return $this->getModelClassNameSnake() . '_attributes_value_id';
    }

    public function getFieldSpecOfAttr()
    {
        if (config('fromSky.admin.list.section.' . $this->getModelClassBaseNameLower() . '.use_attrib')) {

            foreach ($this->getListDynamicsAttr() as $attr) {
                $field                   = $this->fieldToDynamicsInputName($attr->field, $attr->id);
                $this->fieldspec[$field] = [
                    'type'          => $attr->type,
                    'required'      => false,
                    'hidden'        => 0,
                    'label'         => $attr->title,
                    'display'       => 1,
                    'default_value' => $attr->default ?? '',
                    'context'       => 'model_attributes'
                ];
                if ($attr->type === 'text') {
                    $this->fieldspec[$field]['size']     = 600;
                    $this->fieldspec[$field]['h']        = 300;
                    $this->fieldspec[$field]['cssClass'] = 'wysiwyg';
                }
                if ($attr->type === 'media') {
                    $this->fieldspec[$field]['mediaType'] = 'Img';
                    $this->fieldspec[$field]['disk']      = 'images';
                    $this->fieldspec[$field]['folder']    = $this->getMediaFolder();
                }
            }
        }
    }//fn

    /**
     * @return mixed
     * Lấy ra danh sách thuộc tính động
     */
    public function getListDynamicsAttr()
    {
        $modelBaseAttr = $this->getModelNameSpaceAttributes();
        return reGet('users'.__METHOD__,  function () use ($modelBaseAttr) {
            $model = $this;
            return $modelBaseAttr::wherePub(1)->where(function ($query) use ($model) {
                $query->whereNull($model->getIdNameModel());
                if ($model->id != null) {
                    $query->orWhere($model->getIdNameModel(), $model->id);
                }
                return $query;
            })->orderBy('sort')->get();
        },now()->addMinutes(0.5));
    }
}
