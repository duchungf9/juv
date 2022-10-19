<?php namespace App\FromSky\Api\V1\Controllers;

use Url;
use Validator;
use Illuminate\Http\Request;

use App\Model\Template;
use App\FromSky\Admin\NavBarComponent;
use App\FromSky\Admin\DashBoardComponent;
use App\FromSky\Tools\CodeGeneratorHelper;
use App\FromSky\DomainLayer\Admin\Resource\AdminSectionResource;

use App\FromSky\Tools\JsonResponseTrait;

class AdminServicesController
{
    use JsonResponseTrait;

    protected $request;


    public function dashboard(Request $request)
    {
        $this->request = $request;
        $data          = (new DashBoardComponent($this->request))->getData();
        ($data) ? $this->setData($data)->responseSuccess() : $this->setEnableLog(false)->responseWithError();
        return $this->apiResponse();
    }


    public function navbar(Request $request)
    {
        $this->request = $request;
        $data          = (new NavBarComponent($this->request))->getData();
        ($data) ? $this->setData($data)->responseSuccess() : $this->setEnableLog(false)->responseWithError();
        return $this->apiResponse();
    }


    public function sections()
    {
        $items = AdminSectionResource::collection(Template::byTemplate('context')->get());
        return $this->setData($items)->responseSuccess()->apiResponse();
    }

    public function generator(Request $request)
    {
        $this->request = $request;
        $data          = (new CodeGeneratorHelper())->handleGenerator($this->request->data, $this->request->value);
        $this->setData($data)->responseSuccess();
        return $this->apiResponse();
    }
}