<page class="news__single md:me-2 mb-2">
    <h5 class="text-gray-700 mb-1">
        <i class="fa fa-clock me-1"></i>{{ $news->getFormattedDate() }}
    </h5>
    <h1 class="text-blue-600 mb-2">{{ $news->title }}</h1>
    @if($news->video)
        <x-media.video :video="$news->video" :classExtra="'mb-2'"></x-media.video>
    @elseif($news->hasImageMedia())
        <img src="{{ ImgHelper::get_cached(optional($news->imageMedia)->file_name,config('fromSky.image.medium')) }}" alt="{{ $news->title }}" class="max-w-full h-auto mb-2">
    @else
        <img src="https://picsum.photos/seed/picsum/1200/900" alt="{{ $news->title }}" class="max-w-full h-auto mb-2">
    @endif
    {!! $news->description !!}
    @if($news->hasBlocks())
        <div class="my-2">
            @foreach($news->blocks()->sorted()->get() as $block)
                <x-website.page-blocks.item :block="$block" type="blocks"/>
            @endforeach
        </div>
    @endif
    <x-website.partials.page-doc :doc="$news->doc" class="mb-3"/>
</page>
<x-website.widgets.tags :news="$news"/>
<x-website.widgets.sharer :item="$news"/>