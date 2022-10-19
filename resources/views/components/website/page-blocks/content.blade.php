@if($block->subtitle)
    <h5 class="blocks-subtitle text-accent">{!! $block->subtitle !!}</h5>
@endif
<h2 class="blocks-title">{{ $block->title }}</h2>
{!! $block->description !!}
<x-website.ui.button  :item="$block" class="mt-2 mb-2 md:mt-4 inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-3 px-4 leading-tight text-xl {{ $buttonColor ?? 'btn-outline-color-4'}}" />
<x-website.ui.button label="my label" :item="$block" class="mt-2 mb-2 md:mt-4 inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline py-3 px-4 leading-tight text-xl {{ $buttonColor ?? 'btn-outline-color-4'}}" />
<x-website.partials.page-doc :doc="$block->doc" class="mt-2"/>
