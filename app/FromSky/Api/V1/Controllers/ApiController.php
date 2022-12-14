<?php namespace App\FromSky\Api\V1\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\FromSky\Tools\JsonResponseTrait;


/**
 * Class AuthenticateController
 * @package App\FromSky\Api\V1\Controllers
 */
class ApiController extends Controller
{
    use JsonResponseTrait;

    protected $request;
    private $limit = 5;

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit = ($this->request->has('limit')) ?: $this->limit;
    }

    /**
     * @param $action
     * @param Request $request
     * @return mixed
     */
    public function validator($action, Request $request)
    {
        return Validator::make(
            $request->all(),
            config('fromSky.api.validation.' . $action)
        );
    }
}