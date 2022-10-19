{{Form::hidden($key, $value , array('class' => ' form-control '.$css_class))}}
<div class="media-cont">
    <div class="media-input">
           <a href="#" class="btn btn-default filemanager-select"
            data-input="{{$key}}"
            data-collection="{{data_get($properties,'collection')}}"
            data-media-category-id="{{data_get($properties,'media_category_id')}}"
            >
            {{icon('upload')}} {{trans('admin.label.upload_file')}}
        </a>
    </div>
    @if ($value && $media)
        <div id="box_{{$key}}_{{$model->id}}" class="media-saved">
            <div>
                @if ($media->collection_name == 'images')
                    <a href="{{ma_get_image_from_repository($media->file_name)}}" target="_blank">
                        <img class="img-thumb pull-end"
                             src="{{ImgHelper::init('')->get_cached($media->file_name, ['w' => 100, 'h' => 100, 'q' => 50])}}">
                    </a>
                @else
                    <a href="{{ma_get_doc_from_repository($media->file_name)}}" target="_blank" class="btn btn-primary">
                        {{trans('admin.label.view')}}
                    </a>
                @endif
            </div>
            @include('admin.inputs.delete_button', ['key' => $key, 'id' => $model->id,"locale" => $locale])
        </div>
    @endif
</div>

