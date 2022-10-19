<?php namespace App\FromSky\Api\V1\Controllers;


use App\FromSky\DomainLayer\Media\Action\DeleteMediaAction;
use Illuminate\Support\Facades\Log;
use Url;
use Validator;
use Illuminate\Http\Request;

use App\FromSky\Tools\ErrorCodes;
use App\FromSky\Tools\JsonResponseTrait;

use App\Model\Media;
use App\FromSky\DomainLayer\Media\Resource\AdminMediaResource;


class AdminFileMangerController
{
    use JsonResponseTrait;

    /**
     * @var Request
     */
    private Request $request;

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $id = null)
    {
        $this->request = $request;
        $object        = Media::when($id, function ($query) use ($id) {
            $query->orderByRaw('IF(FIELD(id,' . $id . ')=0,1,0)');
        })
            ->when($request->get('collection'), function ($query) use ($request) {
                $query->where('collection_name', $request->get('collection'));
            })
            ->when($request->get('media_category_id'), function ($query) use ($request) {
                $query->where('media_category_id', $request->get('media_category_id'));
            })
            ->where('model_type', '')
            ->orderBy('id', 'DESC')
            ->get();
        $items         = AdminMediaResource::collection($object);
        return $this->setData($items)->responseSuccess()->apiResponse();
    }

    /**
     * This method is used to fetch edit view
     */
    public function edit($id)
    {
        $media = Media::find($id);
        if ($media) {
            return view('admin.helper.filemanager-edit', ['media' => $media]);
        }
        return $this->responseNotFound(__('api.errors.item_not_found'), ErrorCodes::MediaNotFound)->apiResponse();

    }

    public function update($id, Request $request)
    {
        $page = Media::find($id);

        $this->request = $request;

        foreach ($page->getFillable() as $a) {
            $page->$a = $this->request->get($a);
        }

        $page->save();

        // translatable
        if (isset($page->translatedAttributes) && count($page->translatedAttributes) > 0) {
            foreach (config('app.locales') as $locale => $value) {
                foreach ($page->translatedAttributes as $attribute) {
                    // se è un attributo sluggabile;
                    if (isset($page->sluggable) && $this->attributeIsSluggable($attribute, $page->sluggable)) {
                        $attribute_to_slug = (config('app.locale') != $locale) ? $attribute . '_' . $locale : $attribute;
                        $string_value      = $this->setSlugAttributes($a)
                            ->sluggyTranslatable($page, $this->request->get($attribute_to_slug), $locale);

                        $page->translateOrNew($locale)->$attribute = $string_value;
                    } else {
                        if (config('app.locale') != $locale) {
                            $page->translateOrNew($locale)->$attribute = $this->request->get($attribute . '_' . $locale);
                        } else {
                            $page->translateOrNew($locale)->$attribute = $this->request->get($attribute);
                        }
                    }
                }
                $page->save();
            }
        }
        return $this->responseSuccess(__('api.messages.data_update'))->apiResponse();
    }


    function deleteMedia($id)
    {
        $media = Media::find($id);

        if ($media) {
            $response = (new DeleteMediaAction($media))->execute();
            if ($response) {
                return $this->responseSuccess(__('admin.file_manager.deleted'))->apiResponse();
            }
        }
        return $this->responseNotFound(__('api.errors.item_not_found'), ErrorCodes::MediaNotFound)
            ->apiResponse();
    }
}