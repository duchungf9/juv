<?php namespace App\FromSky\Admin\Helpers;

use Illuminate\Support\Str;

/**
 *
 * Class AdminUserHelperTrait
 * @package App\FromSky\Admin\Helpers
 */
trait AdminDynamicsAttributesSaver
{

    public function dynamicsAttributeSaver($model)
    {
        if (!method_exists($model, 'getModelNameSpaceAttributes') || !class_exists($model->getModelNameSpaceAttributes()) || !class_exists($model->getModelNameSpaceAttributesValue())) {
            return false;
        }
        $modelDynamicsValue   = $model->getModelNameSpaceAttributesValue();
        $lstDynamicsAttribObj = $model->getListDynamicsAttr();
        /*
         * read attrib dynamics in a loop and insert or update step by step a row
         */

        foreach ($lstDynamicsAttribObj as $oneDynamicsAttRecord) {
            $dynamicInputName = $model->fieldToDynamicsInputName($oneDynamicsAttRecord->field, $oneDynamicsAttRecord->id);
            if (!isset($this->fieldSpecs[$dynamicInputName])) {
                continue;
            }
            //check role
            $value = collect($this->fieldSpecs[$dynamicInputName]);
            if (!$value->has('roles') || auth_user('admin')->hasRole($value->get('roles'))) {
                $aObjDynamicAttribValue = $modelDynamicsValue::where($model->getIdNameModel(), $model->id)->where($model->getIdNameDynamicsAttr(), $oneDynamicsAttRecord->id)->first();
                if (is_null($aObjDynamicAttribValue)) {
                    $aObjDynamicAttribValue = new $modelDynamicsValue;
                }
                //do save
                $aObjDynamicAttribValue->{$model->getIdNameModel()}        = $model->id;
                $aObjDynamicAttribValue->{$model->getIdNameDynamicsAttr()} = $oneDynamicsAttRecord->id;
                $aObjDynamicAttribValue->title                             = $oneDynamicsAttRecord->title;
                $aObjDynamicAttribValue->type                              = $oneDynamicsAttRecord->type;
                $aObjDynamicAttribValue->value                             = $this->request->get($dynamicInputName, null);
                $aObjDynamicAttribValue->field                             = $oneDynamicsAttRecord->field;
                $aObjDynamicAttribValue->pub                               = $oneDynamicsAttRecord->pub;

                $this->hackedBy($aObjDynamicAttribValue);

                $aObjDynamicAttribValue->save();

                $this->translationHandlersDynamicsAttribValue($model, $aObjDynamicAttribValue, $dynamicInputName);

            }
        }


    }//fn


    /**
     * SAVE TRANSLATIONS
     * @param $aObjDynamicAttribValue
     * @param $field
     */
    function translationHandlersDynamicsAttribValue($model, $aObjDynamicAttribValue, $dynamicInputName)
    {

        // translatable
        if (isset($aObjDynamicAttribValue->translatedAttributes) && count($aObjDynamicAttribValue->translatedAttributes) > 0) {
            foreach (config('app.locales') as $locale => $value) {
                foreach ($aObjDynamicAttribValue->translatedAttributes as $attribute) {
                    if ($aObjDynamicAttribValue->getFieldSpec()[$attribute]['type'] == 'media') {
                        continue;
                    }

                    if (config('app.locale') != $locale) {
                        if ($attribute === 'value') {
                            $aObjDynamicAttribValue->translateOrNew($locale)->$attribute = $this->request->get($dynamicInputName . '-' . $locale);
                            continue;
                        }

                        $modelAttribTranslate = $model->getModelNameSpaceAttributes() . 'Translation';
                        $traslateData         = $modelAttribTranslate::where($model->getIdNameDynamicsAttr(), $aObjDynamicAttribValue->{$model->getIdNameDynamicsAttr()})->whereLocale($locale)->first();
                        if (!is_null($traslateData)) {// && ($attribute === 'title'
                            $aObjDynamicAttribValue->translateOrNew($locale)->$attribute = $traslateData->{$attribute};
                            continue;
                        }
                        $aObjDynamicAttribValue->translateOrNew($locale)->$attribute = $aObjDynamicAttribValue->{$attribute};

                    }

                }
                $aObjDynamicAttribValue->save();
            }
        }
    }


}
