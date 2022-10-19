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
    <x-fromsky_store-shop-banner-component/>
    <section class="py-3">
      <div class="container mx-auto sm:px-4">
            <div class="flex flex-wrap ">
		        <x-website.products.latest></x-website.products.latest>
         	</div>
      </div>
    </section>
@endsection
