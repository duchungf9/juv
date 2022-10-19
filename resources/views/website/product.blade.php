@extends('website.app')
@section('content')
	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb flex items-end">
			<div class="page-breadcrumb__item"><a href="{{$product->category->getPermalink()}}">{{$product->category->title}}</a></div>
			<div class="page-breadcrumb__item">{{$product->title}}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<x-fromsky_store-shop-banner-component/>
	<section class="product-page">
		<div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap  no-gutters">
				<div class="w-full sm:w-1/2 pr-4 pl-4 md:order-1 my-2 md:my-0 product-page-image p-0 m-0 relative">
					<x-website.products.product-gallery :item="$product" :config="'fromSky.image.large'"/>
					<x-website.products.on-sale-badge :product="$product"/>
				</div>
				<div class="w-full sm:w-1/2 pr-4 pl-4 md:order-2">
					<div class="product-page-card">
						<x-website.products.product-description :product="$product"/>
						@if (StoreFeatures::showPrice())
							<div class="h4 product-page-price my-3">
							<x-fromsky_store-product-display-price :product="$product"  :type="'product-page'"/>
							</div>
							<cart-add-item	ref="v100" :product="{!! $product !!}" :min=1 :step="1" :max="100" :value=1>
								<template #btn_label>{{ __('store.items.add') }}</template>
								<template #label>
									<h5	class="product-page-add-label text-italic text-color-4 mb-1">{{ __('store.cart.table.quantity') }}</h5>
								</template>
							</cart-add-item>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
