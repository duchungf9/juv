<?php

namespace App\FromSky\Admin\Controllers;


use Illuminate\Http\Request;
use App\FromSky\Tools\JsonResponseTrait;


/**
 * @property string media
 */
class AjaxUploadifiveMediaController extends AjaxBaseMediaController
{

    use JsonResponseTrait;

    protected string $media = 'Filedata'; // default media request file input
    protected array $fieldspec;

    /*
	|--------------------------------------------------------------------------
	|  Upload Media File using Ajax Method
	|--------------------------------------------------------------------------
	|  Filesystem Disk = > media
	|
	|
	*/
    public function handle(Request $request)
    {
        $modelClass = 'App\\Model\\' . $request->model;

        $this->fieldspec = (new $modelClass)->getFieldSpec();


        //True if the file has been uploaded with HTTP and no error occurred
        if (!$request->file($this->media)->isValid()) {
            return $this->responseWithError('Unable to upload the file or file not valid')->apiResponse();
        }

        $response = $this->validateMedia($request, $this->media);
        if ($response !== true) {
            return $response;
        }

        $file_details = $this->uploadHandler($request);

        // create the media and link it to the model
        $list              = $modelClass::find($request->Id);
        $media_category_id = $request->get('myImgType') ?: 0;
        $mediaObject       = $this->createMedia($file_details, $media_category_id);
        $list->media()->save($mediaObject);

        // response
        $data = $file_details['mediaType'];
        return $this->setData($data)->responseWithSuccess();

    }
}