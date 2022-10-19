<?php
/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 03/07/2016
 * Time: 11:21
 */

namespace App\FromSky\Website\Repos\Product;

/**
 * Interface ProductRepositoryInterface
 * @package App\FromSky\Website\Repos\Product
 */
interface ProductRepositoryInterface
{
    public function getBySlug($slug);

    public function getPublished();
}