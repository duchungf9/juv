<?php

namespace App\FromSky\Admin\Controllers;

use App\Model\Media;
use Illuminate\Http\Request;

class AjaxMediaListController extends AjaxController
{


    public function updateMediaList($mediaType, $model, $id = '')
    {
        $modelClass = 'App\\Model\\' . ucfirst($model);
        $object     = $modelClass::whereId($id)->firstOrFail();
        $media_list = ($mediaType == 'images') ? 'images_list_gallery' : 'docs_list';
        return view('admin.helper.' . $media_list, ['page' => $object]);

    }

    public function updateModelMediaList($modelFilter)
    {
        $object = Media::orderBy('id', 'DESC')->get();
        return view('admin.helper.modal_media_gallery', ['medias' => $object]);
    }

    public function updateMediaSortList(Request $request)
    {
        $i = 1;

        $input = $request->all();
        foreach ($input as $key => $items) {
            $dataObject = explode('_', $key);
            foreach ($items as $id) {
                $modelClass   = 'App\\Model\\' . ucfirst($dataObject[1]);
                $object       = $modelClass::whereId($id)->firstOrFail();
                $object->sort = $i * 10;
                $object->save();
                $i++;
            };
        };
    }
}