@if($payment_method->hasFee())
    <div id="payment_fee_{{$payment_method->id}}" class="payment_method-fee">
        <div class="payment_method-fee-amount">
            {{__('store.payment.payment_fee')}} {{StoreHelper::formatPrice($payment_method->fee)}}
        </div>
        <div class="payment_method-fee-note">
            {!! $payment_method->note!!}

        </div>
    </div>
@endif


