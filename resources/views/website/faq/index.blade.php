@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs :style="$page->breadcrumb_color">
        <div class="text-white page-breadcrumb flex items-end">
            @if($page->parent)
                <div class="page-breadcrumb__item">{{$page->parent->title}}</div>
            @endif
            <div class="page-breadcrumb__item">{{$page->menu_title}}</div>
        </div>
    </x-website.ui.breadcrumbs>
    <x-website.ui.banner class="bg-accent py-5" :item="$page"></x-website.ui.banner>
    <x-website.partials.section class="py-1">
        <x-website.ui.accordion :items="$faqs"/>
    </x-website.partials.section>
@endsection
