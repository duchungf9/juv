@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb d-flex align-items-end">
            @if($page->parent)
                <div class="page-breadcrumb__item">{{$page->parent->title}}</div>
            @endif
            <div class="page-breadcrumb__item">{{$page->menu_title}}</div>
        </div>
    </x-website.ui.breadcrumbs>
    <main class="my-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-3 text-primary">{{__('store.dashboard.welcome')}} {{auth_user()->name}} -
                        <a href="{{route('logout')}}" class="text-accent">Logout</a></h5>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="my-0">
                <x-fromsky_store-order-list-component/>
            </div>

            <div class="my-4 d-none">
                <h3 class="text-muted">{{ trans('store.dashboard.addresses') }}</h3>
                <ul>
                    @foreach ($addresses as $_address)
                        <li>{{$_address->display_inline}}</li>
                    @endforeach
                </ul>
                <a class="btn btn-primary" href="{{url_locale('/users/address-new')}}">
                    {{trans('store.address.new')}}
                </a>
            </div>

        </div>
    </main>

@endsection
