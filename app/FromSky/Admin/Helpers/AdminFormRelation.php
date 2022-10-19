<?php


namespace App\FromSky\Admin\Helpers;


use Illuminate\Support\Str;

/**
 * Trait AdminFormContext
 * @package App\FromSky\Admin\Helpers
 */
trait AdminFormRelation
{
    public function getRelation($selected = '')
    {
        $relationModel = "App\\Model\\" . ucfirst($this->property['model']);
        $model         = new $relationModel;

        $orderField = (data_get($this->property, 'order_field')) ? $this->property['order_field'] : $this->property['label_key'];
        $order      = 'ASC';
        $query      = $model::select(); //$relationModel;

        if (data_get($this->property, 'orderRaw') && count($selected)) {
            $orderRaw = sprintf($this->property['orderRaw'], implode(', ', $selected));
        } else {
            $orderRaw = false;
        }

        if (isset($model->translatedAttributes) && in_array($this->property['label_key'], $model->translatedAttributes)) {
            return $this->getTranslatableRelation();
        } else {
            /** filter condition */
            if (isset($this->property['filter'])) {
                foreach ($this->property['filter'] as $column => $value) {
                    $query->where($column, '=', $value);
                }
            }
            if (data_get($this->property, 'whereRaw')) {
                $query->whereRaw($this->property['whereRaw']);
            }
            if ($orderRaw) {
                $relationObj = $query->orderByRaw($orderRaw)->get();
            } else {
                $relationObj = $query->orderBy($orderField, $order)->get();
            }

            return $relationObj;
        }
    }

    /**
     * GET RELATION DATA FOR
     * TRANSLATABLE TABLE
     * CAN BE FILTERED
     * AND ORDERED
     * @return mixed
     */
    function getTranslatableRelation()
    {
        $relationModel = "App\\Model\\" . $this->property['model'];
        $orderField    = (isset($this->property['order_field'])) ? $this->property['order_field'] : $this->property['label_key'];
        $order         = 'ASC';
        $model         = new $relationModel;
        $query         = $model::select();

        if (isset($this->property['filter'])) {
            foreach ($this->property['filter'] as $column => $value) {
                $query->where($column, '=', $value);
            }
        }

        if (data_get($this->property, 'whereRaw')) {
            $query->whereRaw($this->property['whereRaw']);
        }

        $relationObj = $query->orderBy($orderField, $order)->get();
        return $relationObj;
    }
}