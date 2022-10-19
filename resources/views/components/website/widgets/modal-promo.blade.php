<x-website.ui.modal :model="$model" class="modalPromo modal-lg">
    <div class="modal-body text-center">
        <h5 class="mb-1">{{$model->subtitle}}</h5>
        <h3 class="mb-2">{{$model->title}}</h3>
        {!!  $model->description!!}
        @if($model->btn_title)
            <div class="modal-button">
                <x-website.ui.button :item="$model" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600"/>
            </div>
        @endif
        @if($model->image)
            <img class="modal-image max-w-full h-auto" src="{{ma_get_image_from_repository($model->image)}}" alt="">
        @endif
    </div>
</x-website.ui.modal>



