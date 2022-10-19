@extends('emails.master.html')
@section('content')
    <h3 class="order-step-title" style="margin-bottom:5px;padding-bottom:0px">{{__('store.order.number')}}: {{$order->reference}}</h3>
    {{ trans('store.order.date') }}: {{$order->created_at->format('Y-m-d H:i:s')}}
    <table class="" border="0" cellpadding="2" cellspacing="0" width="570px">
        <tbody>
        <tr>
            <td width="45%">
                <x-fromsky_store-address-component
                        :address="$order->shipping_address"
                        :label="trans('store.order.shipping')"/>
                @if($order->shipping_method)
                    <p><b>{{ trans('store.shipping.method') }}:</b> {{$order->shipping_method}}</p>
                @endif
            </td>
            <td width="10%"></td>
            <td width="45%">
                <x-fromsky_store-address-component
                        :address="$order->billing_address"
                        :label="trans('store.order.billing')"/>
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <x-fromsky_store-resume-component :order="$order"/>

    <table class="" border="0" cellpadding="2" cellspacing="0" width="570px">
        <tbody>
        <tr>
            <td width="100%">
                <p><b>{{ trans('store.payment.method') }}:</b> {{$order->payment_method_display}}</p>
                @if($order->payment->payment_method_id=App\Model\PaymentMethod::BANK_TRANSFER)
                    {!!   $order->orderFeedback(optional($order->payment->payment_method)->description)!!}
                @endif

            </td>
        </tr>
        </tbody>
    </table>
@endsection
