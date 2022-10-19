<?php

namespace App\FromSky\Admin\Helpers;

use Form;
use App;

use App\FromSky\Admin\Decorators\AdminForm\AdminFormBaseComponent;

/**
 * Class AdminTree
 * @package App\FromSky\Admin
 */
class AdminTree extends AdminFormBaseComponent
{

    protected $tree_collection;
    protected $level;

    public function getTreeRelation($obj, $parent = 0, $level = 0)
    {
        if ($obj->where($this->property['tree_field'], $parent)) {
            $level++;
            if (data_get($this->property, 'order_field')){ $obj->sortBy($this->property['order_field']);}
            foreach ($obj->where($this->property['tree_field'], $parent) as $item) {
                $item->title             = $this->createSeparator($level) . $item->title;
                slog('$item->title='.$item->title .' -- $item->id ='.$item->id.' -- $item->parent_id ='. $item->parent_id);
//                slog($item);
                $this->tree_collection[] = $item;
                $this->getTreeRelation($obj, $item->id, $level);
            }
        }
        return $this->tree_collection;
    }

    function createSeparator($level)
    {
        return ($level > 1) ? "|" . str_repeat("__", $level) : '';
    }
}
