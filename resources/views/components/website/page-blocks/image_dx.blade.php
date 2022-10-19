@props([
    'type'=>'blocks',
    'button_color'=>'btn-outline-color-4',
])

<div class="flex flex-wrap  blocks-item">
    <div class="lg:w-1/2 pr-4 pl-4 {{$type}}-content justify-end">
        <x-website.page-blocks.content :block="$block" :buttonColor="$button_color" />
    </div>
    <div class="lg:w-1/2 pr-4 pl-4 blocks-image ">
        @if($block->video)
            <x-media.video :video="$block->video" :classExtra="'mb-2'"></x-media.video>
        @else
            <x-website.page-blocks.image :block="$block" type="blocks" />
        @endif
    </div>
</div>