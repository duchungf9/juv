@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card order-step box-shadow p-2">
                        @include('fromsky_store::cart.address')
                        <h2 class="order-step-title">2. {{ trans('store.cart.step.shipping_and_payment') }}</h2>
                        <h2 class="order-step-title">3. {{ trans('store.cart.confirm') }}</h2>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <x-fromsky_store-cart-products-widget :cart="$cart"/>
                </div>
            </div>
        </div>
    </section>
@endsection
