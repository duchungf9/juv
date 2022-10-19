<?php namespace App\FromSky\Api\V1\Controllers;

use App\Model\Page;
use App\Model\Block;
use App\FromSky\Admin\AdminFormFieldsProcessor as AdminFormFieldsProcessor;
use App\FromSky\Admin\DashBoardComponent;
use App\FromSky\Admin\NavBarComponent;
use App\FromSky\DomainLayer\Block\Resources\BlockCollection;
use App\FromSky\DomainLayer\Block\Resources\BlockResource;
use App\FromSky\Tools\CodeGeneratorHelper;
use Url;
use Validator;
use Illuminate\Http\Request;

use App\FromSky\Tools\JsonResponseTrait;

class AdminCrudController
{
    use JsonResponseTrait;

    protected $request;


    public function create($section, Request $request)
    {
        $this->request = $request;
        $item          = getModelFromString($section);
        (new AdminFormFieldsProcessor($request))->requestFieldHandler($item);
        $this->setData($item)->responseSuccess();
        return $this->apiResponse();
    }

    public function update($section, $id, Request $request)
    {
        $this->request = $request;
        $item          = getModelFromString($section)::find($id);
        (new AdminFormFieldsProcessor($request))->requestFieldHandler($item);
        $data = new BlockResource($item);
        $this->setData($data)->responseSuccess();
        return $this->apiResponse();
    }

}