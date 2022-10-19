@props([
'type'=>'blocks',
'button_color'=>'btn-outline-color-4',
])
<div class=" flex flex-wrap  blocks-item">
    <div class="lg:w-full pr-4 pl-4 blocks-image mb-2">
        @if($block->video)
            <x-media.video :video="$block->video" :classExtra="'mb-2'"></x-media.video>
        @else
            <img src="{{ ma_get_image_from_repository($block->image) }}" class="max-w-full h-auto blocks-img w-full"  alt="{{$block->title}}">
        @endif
    </div>
</div>