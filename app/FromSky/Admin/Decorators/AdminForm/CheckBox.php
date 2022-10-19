<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use Form;
use App;

/**
 * Class AdminTree
 * @package App\FromSky\Admin
 */
class CheckBox extends AdminFormBaseComponent
{

    protected string $active = "active";

    public function render($value, $key)
    {

        $this->modelName = strtolower(class_basename($this->formObject->model));
        $booleanInputId  = $key . '_' . $this->modelName . '_' . $this->formObject->model->id;
        //$formElement = Form::checkbox($key, 1 , $this->model->$key);
        $activeNo   = ($value != '1') ? ' ' . $this->active : '';
        $activeYes  = ($value == '1') ? $this->active : '';
        $checkedYes = ($value == '1') ? 'checked' : '';
        $checkedNo  = ($value != '1') ? 'checked' : '';
        $this->html = '
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
               
                <input 
                onclick="$(\'#' . $booleanInputId . '\').val(1)" 
                type="radio" class="btn-check" name="' . $key . '" id="' . $booleanInputId . '_1" autocomplete="off" ' . $checkedYes . '>
                <label class="btn btn-outline-toggle" for="' . $booleanInputId . '_1">' . trans('admin.label.btn_yes') . '</label>
               
                <input onclick="$(\'#' . $booleanInputId . '\').val(0)"  type="radio" class="btn-check" name="' . $key . '" id="' . $booleanInputId . '_2" autocomplete="off" ' . $checkedNo . '>
                <label class="btn btn-outline-toggle" for="' . $booleanInputId . '_2">' . trans('admin.label.btn_no') . '</label>
            </div>
        ';

        /* GF_ma aggiornato dopo Aggiunta Middleware ConvertEmptyStringsToNull metto di default 0 anzichè null */
        $value      = ($value === null) ? 0 : $value;
        $this->html .= Form::hidden($key, $value, array('id' => $booleanInputId, 'class' => ' form-control ' . $this->formObject->cssClass));
        return $this->html;
    }
}
