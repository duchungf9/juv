<h4 class="mt-2 mb-0"><b>{{ trans('store.payment.method') }}:</b></h4>
{{$order->payment_method_display}} -
{{ ($order->payment->is_paid)? trans('store.payment.paid'):trans('store.payment.unpaid')}}
@if($order->payment->transaction)
    {{__('admin.label.payment_transaction')}} :{{$order->payment->transaction}}
@endif
