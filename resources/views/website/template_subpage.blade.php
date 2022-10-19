@inject('pages','App\Model\Page')
@php $items = $pages::published()->get(); @endphp
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
    <x-website.partials.page-content-full-image :page="$page"/>
    <x-website.partials.page-child :children="$page->children" class="mt-0 pt-1 pb-1"/>
    <x-website.page-blocks.lists :item="$page"/>
    <x-website.partials.section  class="pt-0 pb-2">
        <x-website.widgets.sharer :item="$page" class="text-start"/>
    </x-website.partials.section>
@endsection
