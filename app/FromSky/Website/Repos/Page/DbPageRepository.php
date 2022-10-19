<?php

namespace App\FromSky\Website\Repos\Page;

/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 03/07/2016
 * Time: 10:58
 */

use App\Model\Page;
use App\FromSky\Website\Repos\DbRepository;

class DbPageRepository extends DbRepository implements PageRepositoryInterface
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function getParentPage($parent)
    {
        $page = $this->getBySlug($parent, app()->getLocale());

        // Return false if page has parent because this method is used only for parent page
        if ($page && $page->parent_id != 0) {
            return false;
        }

        return $page;
    }

    public function getSubPage($parent, $child)
    {
        $parent = $this->getBySlug($parent, app()->getLocale());
        $child  = $this->getBySlug($child, app()->getLocale());

        // If $parent or $child doesn't exists
        if (!$parent || !$child) {
            return false;
        }

        // If $parent and $child doesn't match
        if ($parent->id != $child->parent_id) {
            return false;
        }

        // Return $child data
        return $child;
    }
}
