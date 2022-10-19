@inject('pages','App\Model\Page')
@php $items = $pages::published()->get(); @endphp
@extends('website.app')
@section('content')
    {{-- Header --}}
    {{--Banner quảng cáo--}}
    <div class="lg:mt-[105px] mt-[107px] block"></div>
    <div class="hidden lg:block"><x-website.widgets.banners :template="'banner-top'" :id-banner="data_get($site_settings,'home_idBannerCenter1')" :code-banner="'home_idBannerCenter1'" :height="250" :width="970"/></div>

    <x-website.home.chart/>
    <x-website.home.body-top :orderBy="'id'"/>

    <div class="w-full px-[15px] lg:py-[40px] mb-[40px] bg-white">
        <div class="container mx-auto">
            <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'home_idBannerCenter3')" :code-banner="'home_idBannerCenter3'" :height="100" :width="1200"/>
        </div>
    </div>

    {{--<x-website.home.slider class="owl-theme"/>--}}
    {{--<x-website.partials.section class="py-5 bg-accent">
        <x-slot name="caption" class="text-blue-600">{{$page->subtitle}}</x-slot>
        <x-slot name="title" class="text-white h1">{{$page->title}}</x-slot>
        <div class="px-0 text-justify text-white lg:px-6">{!!  $page->description !!}</div>
    </x-website.partials.section>--}}
    {{--    <x-website.carousels.product-carousel :item="$items->find(13)" class="bg-color-5"/>--}}
    {{--<x-website.partials.page-block
            :item="$page->blockById(2)"
            class="bg-color-4 tags"
            classCaption="text-accent"
            color="text-white"
            buttonClass="btn-outline-accent"
    >
    </x-website.partials.page-block>
    <x-website.home.about :item="$items->find(2)" class="bg-white home_about"/>--}}

    {{-- <x-website.partials.section :class="'bg-color-5 py-5'">
        <x-slot name="title" class="h1 text-accent">Metrics</x-slot>
        <x-website.widgets.metrics/>
    </x-website.partials.section> --}}

@endsection
@section('footerjs')
    {{-- <script type="text/javascript" src="/website/js/home/youtube_home.js" defer></script> --}}
@endsection
