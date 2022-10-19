<?php namespace App\FromSky\Admin\Decorators\AdminForm;

use Illuminate\Support\Str;
use Form;
use App;

/**
 * Class SelectBaseComponent
 * @package App\FromSky\Admin
 */
class SelectBaseComponent extends AdminFormBaseComponent
{

    protected string $active = "active";
    protected mixed  $selected;

    public function get($obj, $field, $selItem = '', $selectedArray = '')
    {
        $optionValue    = data_get($this->property, 'foreign_key', 'id');
        $optionName     = data_get($this->property, 'label_key', 'title');
        $isRequired     = data_get($this->property, 'required', false);
        $nullLabel      = data_get($this->property, 'nullLabel', 'Select ' . $this->property['label']);
        $multiple       = (data_get($this->property, 'multiple', '')) ? 'multiple' : '';
        $cssClass       = data_get($this->property, 'cssClass', '');
        $showOnlyValues = data_get($this->property, 'show_only_values', []);
        // hidden field handler
        if (data_get($this->property, 'hidden') == 1) {
            if ($multiple) $html = "<select class=\"form-select hidden\" id=\"" . $field . "\" name=\"" . $field . "[]\" " . $multiple . " >\n";
            else $html = "<select class=\"form-select hidden\" id=\"" . $field . "\" name=\"" . $field . "\" >\n";
        } else {
            if ($multiple) $html = "<select data-placeholder=\"Select an option\" class=\"form-control selectizemulti\" id=\"" . $field . "\" name=\"" . $field . "[]\" " . $multiple . ">\n";
            elseif (Str::of($cssClass)->contains('selectize')) $html = "<select class=\"form-control  " . $cssClass . " \" id=\"" . $field . "\" name=\"" . $field . "\" >\n";
            else $html = "<select class=\"form-select  " . $cssClass . " \" id=\"" . $field . "\" name=\"" . $field . "\" >\n";
        }

        if (!$isRequired) $html .= "<option value=\"0\">" . $nullLabel . "</option>";
        if (count($showOnlyValues) > 0) {
            foreach ($obj as $_key => $item) {
                if (!array_key_exists(auth("admin")->user()->roles->first()->name, $showOnlyValues)) {
                    $obj->forget($_key);
                } else {
                    if (!in_array($item->$optionValue, $showOnlyValues[auth("admin")->user()->roles->first()->name])) {
                        $obj->forget($_key);
                    }
                }
            }
        }
        foreach ($obj as $item) {
            $selected = ($item->$optionValue == $selItem || (is_array($selectedArray) && in_array($item->$optionValue, $selectedArray))) ? 'selected' : '';
            $html     .= "<option value=\"" . $item->$optionValue . "\" " . $selected . ">" . $item->$optionName . "</option>\n";
        }
        $html .= "</select>\n";
        return $html;
    }

    function selected()
    {
        return $this->selected = (data_get($this->property, 'relation_name') != '') ? $this->model->{$this->property['relation_name']}->pluck('id')->toArray() : '';
    }
}
