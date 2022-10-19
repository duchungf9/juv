@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb flex items-end">
            @if($page->parent)
                <div class="page-breadcrumb__item">{{$page->parent->title}}</div>
            @endif
            <div class="page-breadcrumb__item">{{$page->menu_title}}</div>
        </div>
    </x-website.ui.breadcrumbs>
    <x-website.partials.page-content :page="$page"></x-website.partials.page-content>
    <x-website.page-blocks.lists :item="$page"/>
    <x-website.media.thumbnail :item="$page" class="page-thumbnail bg-color-5 mt-5 py-5">
        <x-slot name="title"><h3 class="text-color-4 text-center">Thumbnail Title</h3></x-slot>
    </x-website.media.thumbnail>
    <x-website.partials.section  class="pt-0 pb-2">
        <x-website.widgets.sharer :item="$page" class="text-start"/>
    </x-website.partials.section>
@endsection
