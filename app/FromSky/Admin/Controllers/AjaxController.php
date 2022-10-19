<?php namespace App\FromSky\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\FromSky\Tools\JsonResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Input;
use Image;
use App\FromSky\Tools\UploadManager;
use Illuminate\Support\Str;
use App\Model\Media;

class AjaxController extends Controller
{
    private array $responseContainer = ['status' => 'ko', 'message' => '', 'error' => '', 'data' => ''];
    use JsonResponseTrait;

    protected $request;

    public function update(Request $request, $action, $model, $id = '')
    {
        $this->request = $request;
        switch ($action) {
            case "updateItemField":

                if ($this->request->input('field')) {
                    $field      = $this->request->input('field');
                    $value      = $this->request->input('value');
                    $locale     = ($this->request->filled('locale')) ? $this->request->get('locale') : null;
                    $modelClass = 'App\\Model\\' . $model;
                    $object     = $modelClass::whereId($id)->firstOrFail();

                    if ($locale) {
                        $attribute                                   = substr($field, 0, -3);
                        $object->translateOrNew($locale)->$attribute = $value;
                    } else {
                        $object->$field = $value;
                    }

                    $object->save();
                    reFlushAdmin();
                    return $this->setData($object)->responseWithSuccess('Data has been updated');
                }
        }
        return $this->responseWithError('Data not found')->apiResponse();
    }

    public function delete($model, $id = '')
    {
        $modelClass = 'App\\Model\\' . ucFirst($model);
        $object     = $modelClass::whereId($id)->first();
        if (is_object($object)) {
            $object->delete();
            reFlushAdmin();

            return $this->responseWithSuccess('Data has been deleted');
        }
        return $this->responseWithError('Data not found')->apiResponse();
    }

    public function responseHandler()
    {
        return response()->json($this->responseContainer);
    }

    /**
     * This method is used to upload filemanager image or docs
     */
    public function uploadFileManager(Request $request)
    {
        $media = 'Filedata';

        if (request()->hasFile($media) && request()->file($media)->isValid()) {
            $UM       = new UploadManager;
            $fileData = $UM->init($media, $request)->store()->getFileDetails();

            $c                    = new Media;
            $c->title             = $fileData['fullName'];
            $c->file_name         = $fileData['fullName'];
            $c->size              = $fileData['size'];
            $c->collection_name   = $fileData['mediaType'];
            $c->media_category_id = 0;
            $c->file_ext          = $fileData['extension'];
            $c->save();

            $this->responseContainer['status'] = 'ok';
            $this->responseContainer['id']     = $c->id;
            $this->responseContainer['data']   = $fileData['mediaType'];

            return $this->responseHandler();
        }
    }


    /**
     * Edited: GF_ma check if the field is translatable.
     *
     * @param $model : The model.
     * @param $key : The field to look for.
     *
     * @return bool: True if translatable, false otherwise.
     */
    protected function isTranslatableField($model, $key)
    {
        return (property_exists($model, 'translatedAttributes') && in_array($key, $model->translatedAttributes));
    }

    /*
     * clear cache with type : website, admin
     *
     */
    public function routerClearCache()
    {
        $type         = request("type", 'Website');
        $user         = auth()->guard("admin")->user();
        $hasRoleClear = $user->hasRole("su") || $user->hasRole("admin");
        if (!$hasRoleClear) {
            return $this->setLogAndSendClient($type, false);
        }
        //do clear
        $clearExec = ($type === 'Website')?(reFlushWebsite()):(($type === 'Admin')?reFlushAdmin():false);
        return $this->setLogAndSendClient($type, $clearExec);
    }

    /**
     * Set log and send client data
     * @param $type
     * @param $ok
     * @return \Illuminate\Http\JsonResponse
     */
    private function setLogAndSendClient($type, $ok)
    {
        if ($ok) {
            activity()->causedBy(auth()->guard("admin")->user())->log("Has clear cache at " . $type);
            return response()->json(['success' => 1, 'msg' => "Cache clear for {$type}!"]);
        }
        activity()->causedBy(auth()->guard("admin")->user())->log("Has clear cache at " . $type);
        return response()->json(['fail' => 1, 'msg' => "Cache clear for {$type} error!"]);
    }
}
