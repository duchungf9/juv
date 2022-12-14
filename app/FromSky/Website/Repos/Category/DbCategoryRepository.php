<?php

namespace App\FromSky\Website\Repos\Category;
/**
 * Created by PhpStorm.
 * User: Marco Asperti
 * Date: 03/07/2016
 * Time: 10:58
 */

use App\Model\Category;
use App\FromSky\Website\Repos\DbRepository;

/**
 * Class DbCategoryRepository
 * @package App\FromSky\Website\Repos\Category
 */
class DbCategoryRepository extends DbRepository implements CategoryRepositoryInterface
{
    /**
     * @var Category
     */
    protected $model;

    /**
     * DbCategoryRepository constructor.
     * @param Category $model
     */
    function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * return the  active categories
     * override publish method
     * @return mixed
     */
    function getPublished()
    {
        return $this->published()->orderBy('sort')->get();
    }
}
