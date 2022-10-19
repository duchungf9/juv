@if (Session::has('message'))
    <div class="flash alert alert-danger {{ Session::has('message_important') ? 'alert-important':''}} pf25 mb15">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        {{ session('message') }}
    </div>
@endif

<div class="cart-resume d-flex justify-content-between">
    <h2 class="cart-resume-title text-primary">1. {{trans('store.order.addresses')}}</h2>
    <a href="{{route('store.cart.step_1')}}" class="cart-resume-edit">
        <span class="d-none  d-md-block">{{trans('store.cart.step.edit_address')}}</span>
        <span class="d-md-none">{{trans('store.cart.step.edit')}}</span>

    </a>
</div>
@if(last(request()->segments())!='payment')
    <div class="cart-resume  border-top pt-2 d-flex justify-content-between">
        <h2 class="cart-resume-title text-primary">2. {{ trans('store.cart.step.shipping_and_payment') }}</h2>
        <a href="{{url_locale('/cart/payment')}}" class="cart-resume-edit">
            <span class="d-none  d-md-block">{{trans('store.cart.step.edit_shipping_and_payment')}}</span>
            <span class="d-md-none">{{trans('store.cart.step.edit')}}</span>
        </a>
    </div>
@endif




