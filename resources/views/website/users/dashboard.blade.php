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
	<main class="my-2">
        <div class="container mx-auto sm:px-4">
			@if (StoreFeatures::isStoreEnabled())
				<div class="my-0">
					<x-fromsky_store-order-list-component/>
				</div>
				<div class="my-4 hidden">
					<h3 class="text-gray-700">{{ trans('store.dashboard.addresses') }}</h3>
					<ul>
						@foreach ($addresses as $_address)
							<li>{{$_address->display_inline}}</li>
						@endforeach
					</ul>
					<a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600" href="{{url_locale('/users/address-new')}}">
						{{trans('store.address.new')}}
					</a>
				</div>
			@endif
        </div>
    </main>

@endsection
