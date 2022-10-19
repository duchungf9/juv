@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.cart.title')"/>
    <section>
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card order-step box-shadow p-2">
                        @include('fromsky_store::cart.step_menu')
                        @include('fromsky_store::cart.confirm')
                        <div class="d-flex justify-content-end my-3 d-none d-md-flex">
                            <a href="{{url_locale('order-send')}}" type="submit" class="btn btn-accent">
                                {{trans('store.order.confirm')}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <x-fromsky_store-cart-products-widget :cart="$cart"/>
                    <div class="d-grid gap-1 d-md-flex justify-content-md-end mt-3">
                        <a href="{{url_locale('order-send')}}" type="submit" class="btn btn-accent">
                            {{trans('store.order.confirm')}}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
