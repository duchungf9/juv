@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card order-info box-shadow ">
                        @include('fromsky_store::cart.step_menu')
                        <h2 class="order-step-title">2. {{ trans('store.cart.step.shipping_and_payment') }}</h2>
                        <form class="mb-4 pl-lg-3" action="{{url_locale('/cart/payment')}}" method="post">
                            {{ csrf_field() }}
                            <x-fromsky_store-shipping-method-component :cart="$cart"/>
                            <x-fromsky_store-payment-method-component :cart="$cart"/>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-accent btn-xs-block ">
                                    {{trans('store.cart.step.next_confirm')}}
                                </button>
                            </div>
                        </form>
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


