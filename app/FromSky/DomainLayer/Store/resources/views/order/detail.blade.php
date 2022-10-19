@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb d-flex align-items-end">
            @if($page->parent)
                <div class="page-breadcrumb__item"><a href="{{route('user.dashboard')}}">{{$page->title}}</a></div>
            @endif
            <div class="page-breadcrumb__item">{{__('store.order.title')}} #{{$order->reference}} </div>
        </div>
    </x-website.ui.breadcrumbs>
    <main class="my-2">
        <div class="container">
            <h3 class="text-primary mb-0">{{__('store.order.number')}}: {{$order->reference}}</h3>
            <h5 class="text-primary mb-1">{{ trans('store.order.date') }}: {{$order->created_at->format('Y-m-d H:i:s')}}</h5>
            <div class="row">
                <div class="col-12 col-md-6">
                    <x-fromsky_store-address-component
                            :address="$order->shipping_address"
                            :label="trans('store.order.shipping')"/>
                </div>
                <div class="col-12 col-md-6">
                    <x-fromsky_store-address-component
                            :address="$order->billing_address"
                            :label="trans('store.order.billing')"/>
                </div>
                <div class="col-12">
                    <x-fromsky_store-order-payment-component :order="$order"/>
                    <x-fromsky_store-order-shipping-component :order="$order"/>
                    <hr class="my-2 text-white"/>
                    <x-fromsky_store-resume-component :order="$order"/>
                </div>
            </div>
        </div>
    </main>

@endsection

