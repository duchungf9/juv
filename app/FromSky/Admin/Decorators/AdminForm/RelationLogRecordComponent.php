<?php

namespace App\FromSky\Admin\Decorators\AdminForm;


use App\FromSky\Admin\Helpers\AdminFormRelation;


/**
 * Class RelationSelectComponent
 * @package App\FromSky\Admin
 */
class RelationLogRecordComponent extends InputComponent
{
    use AdminFormRelation;

    protected string $active = "active";
    protected mixed $selected;

    function render($key, $value, $locale = '')
    {
        $this->selected();
        $this->property['filter'] = ['id' => $value];
        $objRelation              = $this->getRelation($this->selected);
        return $this->get($objRelation, $key, $value, $this->selected);
    }


    public function get($obj, $key, $selItem = '', $selectedArray = '')
    {

        $id         = data_get($this->property, 'foreign_key', 'id');
        $field_date = data_get($this->property, 'field_date', 'updated_at');

        //Get value
        $userData = null;
        foreach ($obj as $item) {
            if ($item->$id == $selItem || (is_array($selectedArray) && in_array($item->$id, $selectedArray))) {
                $userData = $item;
                break;
            }
        }
        if (is_null($userData) && request()->is('admin/create/*')) {
            $userData = auth()->guard('admin')->user();
        }
        if ($this->model->$field_date === null && request()->is('admin/create/*')) {
            $this->model->$field_date = now()->toDateTimeString();
        }
        $html = "<div><strong>" . ($userData->first_name??'---') . " " . ($userData->last_name??'---') . " (" . strip_tags(($userData->email??'---'), '<br>') . ")</strong> lúc <i>" . $this->model->$field_date . "</i></div>";
        return $html;
    }

    function selected()
    {
        return $this->selected = (data_get($this->property, 'relation_name') != '') ? $this->model->{$this->property['relation_name']}->pluck('id')->toArray() : '';
    }
}
