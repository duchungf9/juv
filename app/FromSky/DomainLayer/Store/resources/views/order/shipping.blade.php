@if($order->shipping_method)
    <h4 class="mt-2 mb-0"><b>{{ trans('store.shipping.method') }}:</b></h4>
    {{$order->shipping_method}}
@endif
