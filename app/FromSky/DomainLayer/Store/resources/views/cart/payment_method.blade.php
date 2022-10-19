<h4 class="order-sub-step-title mt-2">{{ trans('store.payment.method') }}</h4>
<div class="row">
    <div class="col-12">
        @foreach ($payment_methods as $_method)
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" required name="payment_method_id" value="{{$_method->id}}" {{($cart->payment_method_id==$_method->id)?'checked':''}}>
                <label class="form-check-label">{{$_method->title}}</label>
                <x-fromsky_store-payment-fee-component :paymentMethod="$_method"/>
            </div>

        @endforeach
        <x-website.ui.input-error-label class="pt-1" for="payment_method_id" srequired/>
    </div>
</div>





