@extends('website.app')
@section('content')
    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb d-flex align-items-end">
            <div class="page-breadcrumb__item">{!!  __('store.order.success') !!}</div>
        </div>
    </x-website.ui.breadcrumbs>
    <main class="main-cart">
        <div class="container">
            <h4 class="text-primary">
                {!!  __('store.order.reference') !!} <span class="text-accent">{{$order->order_reference}}</span>
            </h4>
            {!!   $order->orderFeedback(optional($payment->payment_method)->description)!!}
            <p>
                {{__('store.order.info')}}
                <span class="text-accent">{{$order->order_reference}}</span>
            </p>
            @include('flash::notification')
        </div>
    </main>
@endsection
