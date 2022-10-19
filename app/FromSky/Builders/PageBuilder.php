<?php

namespace App\FromSky\Builders;

/**
 *
 */
class PageBuilder extends FromSkyCmsBuilder
{
    /**
     * @return mixed
     */
    public function menuItems()
    {

        return $this->published()->menu()
            ->with(['parent' => function ($query) {
                $query->published()->menu();
            }])
            ->orderBy('sort', 'Asc');
    }

    /**
     * @param $id
     * @return PageBuilder
     */
    public function childrenMenu($id)
    {
        return $this->where('parent_id', $id)->where('top_menu', 1)->orderBy('sort', 'asc');
    }

    /**
     * @param string $id
     * @return PageBuilder
     */
    public function pageChildren($id = '')
    {
        return $this->where('parent_id', $id)->orderBy('sort', 'asc');
    }

    /**
     * @return PageBuilder|m.\App\FromSky\Builders\PageBuilder.where
     */
    public function top()
    {
        return $this->where('parent_id', 0);
    }

    /**
     * @return PageBuilder
     */
    public function menu()
    {
        return $this->where('top_menu', 1);
    }
}
