@extends('website.app')
@section('bodyBg', 'bg-white')
@section('content')
    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb flex items-end">
            @if($page->parent)
                <div class="page-breadcrumb__item">{{$page->parent->title}}</div>
            @endif
            <div class="page-breadcrumb__item">{{$page->title}}</div>
        </div>
    </x-website.ui.breadcrumbs>
{{--    <x-fromsky_store-shop-banner-component/>--}}
    <x-website.categories.index></x-website.categories.index>
@endsection
