<section {{ $attributes->merge(['class' => 'page-child']) }}>
    <div class="container mx-auto sm:px-4">
        @foreach($children as $child)
            <div id="{{$child->slug}}" class="flex flex-wrap   {{ ($loop->last) ?'':' pb-2 mb-2' }}">
                <a name="#{{$child->slug}}"></a>
                <div class=" relative flex-grow max-w-full flex-1 px-4 w-full lg:w-3/5 pr-4 pl-4 mb-2 lg:mb-0  {{$loop->even ? 'lg:order-1' :'lg:order-12' }}">
                    <x-website.partials.page-media-block :item="$child"/>
                </div>
                <div class="relative flex-grow max-w-full flex-1 px-4  w-full lg:w-2/5 pr-4 pl-4  {{$loop->even ? 'lg:order-12' :'lg:order-1' }} text-blue-600">
                    @if($child->subtitle!='')
                        <h6 class="text-accent ">{!! $child->subtitle !!}</h6>
                    @endif
                    <h2 class="text-blue-600 uppercase ">{!! $child->title !!}</h2>
                    <div class="text-justify">{!! $child->description !!}</div>
                    @if($child->doc)
                        <a target="_new" class="download" href="{{ma_get_doc_from_repository($child->doc)}}">
                            <img src="{{asset(config('fromSky.admin.path.public').'/website/images/download_pdf.png')}}"
                                 class="img-responsive-100 download-icon" alt="{{ trans("website.download")  }}">
                            {!! trans("website.download") !!}
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
