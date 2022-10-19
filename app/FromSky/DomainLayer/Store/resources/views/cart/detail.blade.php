@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section class="cart-list pb-3 pb-md-4">
        @if (!$cart->isEmpty())
            <cart-resume
                    :cart-data="{{$cart->cart}}"
                    :cart-items="{{$cart->items}}"
                    cart_url="{{ url_locale('order-submit')}}"></cart-resume>
        @else
            <div class="container">
                <div class="row my-3">
                    <div class="col-12">
                        <x-ui.alert class="text-center alert-color-4 d-flex align-items-center">
                            {{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
                            <div>{!! __('store.cart.empty')!!}</div>
                        </x-ui.alert>
                    </div>
                </div>
            </div>
            <div class="container cart-action pt-1 pb-4">
                <div id="cart-buttons" class="d-flex justify-content-between">
                    <x-website.ui.button :label="__('store.cart.back')"
                            :route="'shop.index'"
                            class="btn btn-primary btn-sm-block"/>

                </div>
            </div>
        @endif
    </section>





@endsection
