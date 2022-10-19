<section {{ $attributes->merge(['class' => 'py-3']) }}>
    <div class="container mx-auto sm:px-4">
        <div class="flex flex-wrap ">
            @if($contentHasMedia())
                <div class="w-full mb-2">
                    <x-website.partials.page-media-block :item="$page"/>
                </div>
            @endif
            <div class="w-full">
                <x-website.partials.page-title>
                    {{ $page->title }}
                    @if($page->subtitle)
                        <x-slot name="subtitle">{{ $page->subtitle }}</x-slot>
                    @endif
                </x-website.partials.page-title>
                {!! HtmlHelper::content_part($page->description,1) !!}
                @foreach(HtmlHelper::content_part_looper($page->description) as $part)
                    {!! $part !!}
                @endforeach
                <x-website.partials.page-doc :doc="$page->doc"/>
            </div>
        </div>
    </div>
</section>
