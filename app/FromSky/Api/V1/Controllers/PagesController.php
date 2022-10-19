<?php


namespace App\FromSky\Api\V1\Controllers;


use App\Model\Page;
use App\Http\Resources\PageResource;
use App\FromSky\Tools\JsonApiResponseTrait;

class PagesController extends BaseApiController
{
    use JsonApiResponseTrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    function index()
    {
        return PageResource::collection(Page::paginate(10));
    }

    function show($id)
    {
        $item = Page::find($id);
        return new PageResource($item);
    }
}