<?php

namespace App\FromSky\Website\Repos\Product;
/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 03/07/2016
 * Time: 10:58
 */

use App\Model\Product;
use App\FromSky\Website\Repos\DbRepository;

/**
 * Class DbProductRepository
 * @package App\FromSky\Website\Repos\Product
 */
class DbProductRepository extends DbRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    protected $model;

    /**
     * DbProductRepository constructor.
     * @param Product $model
     */
    function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * return the  active products
     * override publish method
     * @return mixed
     */
    function getPublished()
    {
        return $this->model->published()->orderBy('sort')->get();
    }
}