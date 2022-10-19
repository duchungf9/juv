@if($item->video)
    <x-media.video :video="$item->video"/>
@elseif($item->hasGallery())
    <x-website.media.media-carousel :item="$item" class="border border-gray-100 bg-gray-100 pb-3" >
    </x-website.media.media-carousel>
@else
    <img src="{!! ImgHelper::get_cached($item->image, config('fromSky.image.medium')) !!}"
         alt="{{ $item->title }}" border="0" class="max-w-full h-auto w-full">
@endif
