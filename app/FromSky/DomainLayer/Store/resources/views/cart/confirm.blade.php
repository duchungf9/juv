<h2 class="order-step-title">3. {{ trans('store.cart.confirm') }}</h2>
<div class="row">
    <div class="col-6">
        <h5 class="order-step-resume-title"><b>{{ trans('store.order.shipping') }}</b></h5>
        {!!  $cart->shipping_address->display('<br>')!!}
    </div>
    <div class="col-6">
        <h5 class="order-step-resume-title"><b>{{ trans('store.order.billing') }}</b></h5>
        {!! optional($cart->display_billing_address)->display('<br>')!!}
    </div>
</div>
<div class="row">
    <div class="col-12 mt-3">
        <h5 class="order-step-resume-title"><b>{{ trans('store.payment.method') }}:</b> {{$cart->payment_method->title}}
        </h5>
        @if($cart->displayShippingCost())
            <h5 class="order-step-resume-title">
                <b>{{ trans('store.shipping.method') }}:</b> {{$cart->shipping_method->title}}
            </h5>
        @endif
    </div>
</div>



