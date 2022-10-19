@props([
    'class'
])
<x-website.partials.section  class="{{$class}}">
    <x-slot name="caption" class="text-accent">{{$item->subtitle}}</x-slot>
    <x-slot name="title" class="h1 text-blue-600">{{$item->title}}</x-slot>
    <div class="px-lg-15 mb-3 text-justify">{!!  $item->description !!}</div>
    <x-website.ui.button  :item="$item" class="text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600" />
</x-website.partials.section>

