<?php
/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 03/07/2016
 * Time: 11:21
 */

namespace App\FromSky\Website\Repos\Page;
/**
 * Interface PageRepositoryInterface
 * @package App\FromSky\Website\Repos\Page
 */
interface PageRepositoryInterface
{
    /**
     * @param $slug
     * @return mixed
     */
    public function getBySlug($slug);

    public function getSubPage($parent, $child);

}
