@props([
    'class',
    'classCaption',
    'classTitle',
    'classContent',
    'item',
])
<x-website.partials.section class="{{$class??''}}">
    <x-slot name="caption" class="{{$classCaption ?? 'text-blue-600'}}">{!! $item->subtitle!!}</x-slot>
    <h1 class="{{$classTitle ?? 'text-white'}} banner-title">{!! $item->title !!}</h1>
        @if($item->description)
        <div class="banner-content {{$classContent ?? 'text-white'}}">{!!  $item->description !!}</div>
    @endif
</x-website.partials.section>