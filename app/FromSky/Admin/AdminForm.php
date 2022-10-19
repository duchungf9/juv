<?php namespace App\FromSky\Admin;

use Form;
use Str;
use App;


use App\FromSky\Admin\Helpers\AdminFormContext;
use App\FromSky\Admin\Helpers\AdminFormRelation;
use App\FromSky\Admin\Helpers\AdminFormResolverComponentTrait;


/**
 * Generete the admin form for a given
 * Model
 *
 * Class AdminForm
 *
 * @package App\FromSky\Admin
 */
class AdminForm
{

    /**
     * @var
     */
    public $model;
    /**
     * @var
     */
    public $cssClass;
    /**
     * @var string
     */
    protected string $html;
    /**
     * @var
     */
    protected $property;
    /**
     * @var
     */
    protected $showSeo;
    protected $showAttr;
    /**
     * @var
     */
    protected $headerLabelRow;
    /**
     * @var
     */
    protected $cssRow;

    use AdminFormContext, AdminFormRelation, AdminFormResolverComponentTrait;

    /**
     * @param $model
     * @return void
     */
    public function get($model)
    {
        $this->showSeo = false;
        $this->initForm($model);
        echo $this->render();
    }

    /**
     * @param $model
     * @return void
     */
    public function getSeo($model)
    {
        $this->showSeo = true;
        $this->initForm($model);
        echo $this->render();
    }

    /**
     * @return string
     */
    public function render()
    {
        return $this->html;
    }

    /**
     * @return mixed|string
     */
    public function cssRow()
    {
        return $this->cssRow = (isset($this->property['cssRow'])) ? $this->property['cssRow'] : '';
    }

    /**
     * @return string
     */
    public function headerLabelRow()
    {
        return $this->headerLabelRow = (isset($this->property['headerLabel'])) ? "<h3 class=\"ml10 mb20\">" . $this->property['headerLabel'] . "</h3>" : '';
    }


    /**
     * @param $model
     */
    protected function initForm($model)
    {
        $this->html  = "";
        $this->model = $model;
        foreach ($this->model->getFieldSpec() as $key => $property) {
            if ($this->handleContext($key, $property)) {
                $this->formModelHandler($property, $key, $this->model->$key);
            }
        }
        // init lang only if context it's empty
        if ($this->context == '') {
            $this->initLanguages();
        }
        /*if ($this->context == 'model_attributes') {
            $this->initLanguagesDynamicsAttr();
        }*/
    }

    /*
    |--------------------------------------------------------------------------
    | HANDLE THE LANG SECTION
    |--------------------------------------------------------------------------
    */
    /**
     *
     */
    public function initLanguages()
    {
        if (isset($this->model->translatedAttributes) && count($this->model->translatedAttributes) > 0) {
            $this->model->fieldspec = $this->model->getFieldSpec();
            foreach (config('app.locales') as $locale => $value) {
                if (config('app.locale') != $locale) {
                    $target     = "language_box_" . Str::slug($value) . "_" . Str::random(160);
                    $this->html .= $this->containerLanguage($locale, $value, $target);
                    $this->html .= "<div class=\"collapse language_box\" id=\"" . $target . "\">";
                    foreach ($this->model->translatedAttributes as $attribute) {
                        $value          = (isset($this->model->translate($locale)->$attribute)) ? $this->model->translate($locale)->$attribute : '';
                        $this->property = $this->model->fieldspec[$attribute];
                        if (Str::startsWith($attribute, 'seo') == $this->showSeo)
                            $this->formModelHandler($this->model->fieldspec[$attribute], $attribute . '_' . $locale, $value, $locale);
                    }
                    $this->html .= "</div>";
                }
            }
        }
    }


    /**
     * @return string|void
     */
    public function initLanguagesDynamicsAttr()
    {
        $modelClassAttr = $this->model->getModelNameSpaceAttributesValue();
        if (!class_exists($modelClassAttr)) {
            return '';
        }
        $specAttributes = $this->model->getListDynamicsAttr();
        if (count($specAttributes) > 0) {
            $this->model->fieldspec = $this->model->getFieldSpec();
            foreach (config('app.locales') as $locale => $value) {
                if (config('app.locale') != $locale) {
                    $target     = "language_box_" . Str::slug($value) . "_" . Str::random(160);
                    $this->html .= $this->containerLanguage($locale, $value, $target);
                    $this->html .= "<div class=\"collapse language_box\" id=\"" . $target . "\">";
                    foreach ($specAttributes as $itemSpecAtt) {
                        $fieldName      = $this->model->fieldToDynamicsInputName($itemSpecAtt->field, $itemSpecAtt->id);
                        if(isset($this->model->fieldspec[$fieldName])){
                            $this->property = $this->model->fieldspec[$fieldName];
                            $this->formModelHandler($this->model->fieldspec[$fieldName], $fieldName . '-' . $locale, null, $locale);
                        }
                    }
                    $this->html .= "</div>";
                }
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | COMPONENT SECTION
    | COMPONENT CAN BE GENERATED BY DEDICATE CLASS
    | OR BY VIEW IN ADMIN.INPUT FOLDER
    |--------------------------------------------------------------------------
    */
    /**
     * @param $property
     * @param $key
     * @param mixed $value
     * @param mixed $locale
     */
    private function formModelHandler($property, $key, mixed $value = '', mixed $locale = '')
    {
        $this->property = $property;
        // populate field default value if the model is empty
        $value     = (isset($this->property['default_value']) && empty($this->model->id)) ? $this->property['default_value'] : $value;
        /*$attrValue = $this->formModelHandlerDynamicsAttr($key, $locale);
        if (!empty($attrValue)) {
            $value = $attrValue;
        }*/
        $cssClassElement  = data_get($this->property, 'cssClassElement');
        $field_properties = ['class' => ' form-control ' . data_get($this->property, 'cssClass')];

        // return if display property is false
        if (data_get($this->property, 'lang') || $this->property['display'] != 1) return;

        $formElement = $this->renderComponent($value, $key, $field_properties, $locale);
        // add component to html bag
        $this->html .= $this->container($formElement, $cssClassElement, $key, $value, $locale);

    }

    /**
     * Create form dynamic for model has dynamic attrib
     * @param $field
     * @return mixed|string
     */
    private function formModelHandlerDynamicsAttr($field, $locale = '')
    {
        if (Str::startsWith($field, 'dynamicsAttr') && !empty($this->model->id)) {
            $objField = $this->model->dynamicsInputNameToField($field);
            $modelDynamicAttribValue    = $this->model->getModelNameSpaceAttributesValue();
            $attrId   = $objField->dynamicId;
            $attrData = $modelDynamicAttribValue::where([
                $this->model->getIdNameModel()        => $this->model->id,
                $this->model->getIdNameDynamicsAttr() => $attrId,
            ])->first();
            if (!is_null($attrData)) {
                if (empty($locale)) {
                    return $attrData->value;
                }
                $modelDynamicAttribValueTranslate = $modelDynamicAttribValue . 'Translation';
                $traslateData   = $modelDynamicAttribValueTranslate::where($this->model->getIdNameDynamicsAttrValue(), $attrData->id)->whereLocale($locale)->first();
                if (!is_null($traslateData)) {
                    return $traslateData->value;
                }
            }
        }
        return '';
    }

    /*
    |--------------------------------------------------------------------------
    | CONTAINER SECTION
    | WRAP THE COMPONENT INTO CONTAINER
    |--------------------------------------------------------------------------
    */

    /**
     * @param $formElement
     * @param $cssClassElement
     * @param $key
     * @param $value
     * @param string $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|mixed
     */
    function container($formElement, $cssClassElement, $key, $value, $locale = '')
    {
        // Don't wrap component if hidden
        if (data_get($this->property, 'hidden')) return $formElement;

        if ($this->property['type'] == 'media') {
            return $this->containerMedia($formElement, $cssClassElement, $key, $value, $locale);
        }

        return view('admin.inputs.container', ['properties' => $this->property, 'form_element' => $formElement, 'css_class' => $cssClassElement]);
    }

    /**
     * @param $formElement
     * @param $cssClassElement
     * @param $key
     * @param $value
     * @param string $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function containerMedia($formElement, $cssClassElement, $key, $value, $locale = '')
    {
        $media_view = (data_get($this->property, 'uploadifive')) ? 'upload' : 'media';
        return view('admin.inputs.container_' . $media_view,
            ['properties'   => $this->property,
             'form_element' => $formElement,
             'css_class'    => $cssClassElement,
             'key'          => $key,
             'value'        => $value,
             'model'        => $this->model,
             'locale'       => $locale]);
    }


    /**
     * @return mixed
     */
    function extraMsgHandler()
    {
        return data_get($this->property, 'extraMsg');
    }

    /*
    |--------------------------------------------------------------------------
    | LANGUAGE SECTION HELPER
    |--------------------------------------------------------------------------
    */

    /**
     * @param $locale
     * @param $label
     * @param $target
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function containerLanguage($locale, $label, $target)
    {
        return view('admin.inputs.language_header', ['locale' => $locale, 'label' => $label, 'target' => $target]);
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }
}
