<?php
/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 03/07/2016
 * Time: 11:21
 */

namespace App\FromSky\Website\Repos\Category;

/**
 * Interface CategoryRepositoryInterface
 * @package App\FromSky\Website\Repos\Category
 */
interface CategoryRepositoryInterface
{
    public function getBySlug($slug);

    public function getPublished();
}
