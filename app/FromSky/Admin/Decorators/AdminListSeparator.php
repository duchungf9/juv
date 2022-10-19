<?php


namespace App\FromSky\Admin\Decorators;

/**
 * Trait AdminListSeparator
 * @package App\FromSky\Admin\Decorators
 */
trait AdminListSeparator
{
    protected $separator_attribute = null;
    protected $separator_attribute_value = null;
    protected $separator_col_span = 1;

    public function getGroupBySeparatorAttribute($page)
    {

        return ($this->separator_attribute != '') ? " data-group-by-separator=" . $this->getGroupBySeparatorValue($page) . " " : '';
    }

    public function getGroupBySeparatorValue($page)
    {
        return $this->separator_attribute_value = ($this->separator_attribute != '') ? $page->{$this->separator_attribute} : '';
    }

    public function showGroupBySeparator($page)
    {
        if ($this->separator_attribute == '') return;
        if (request()->has('orderBy')) return;
        return $page->{$this->separator_attribute} != $this->separator_attribute_value;
    }


    public function groupBySeparator()
    {
        $this->separator_attribute = data_get($this->property, 'group_by_separator_field', '');
    }

    protected function isGroupBySeparator($item)
    {
        return data_get($item, 'type') == self::GROUP_BY_SEPARATOR;
    }

    protected function counterSpan()
    {
        $this->separator_col_span = (collect($this->property['field'])->count()) + 2;
    }

    public function separatorColSpan()
    {
        return $this->separator_col_span;
    }
}