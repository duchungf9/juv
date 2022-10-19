<table border="1" cellpadding="3" cellspacing="0" width="100%" class="table table-bordered">
    <thead>
    <tr class="table-light">
        <th>{{__('store.cart.table.name')}}</th>
        <th width="80px" class="text-center" align="center">{{__('store.cart.table.quantity')}}</th>
        <th class="text-center">{{__('store.cart.table.price')}}</th>
        <th class="text-center">{{__('store.cart.table.total')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->order_items()->get() as $item)
        <tr id="table_row_{{$item->id}}">
            <td>{!! $item->product_description  !!}</td>
            <td class="text-center" width="80px" align="center">{!! $item->quantity  !!}</td>
            <td class="text-end" align="right"><span
                        class="item-price">{{StoreHelper::formatPrice($item->price)}}</span></td>
            <td class="text-end" align="right"><span id="item_total_price_{{$item->id}}"
                        class="item-total-price">{{StoreHelper::formatPrice($item->total_price)}}</span>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td id="cart-big-total" colspan="9" align="right">
            <p>{{ __('store.order.products_cost') }}
                : {{StoreHelper::formatPrice($order->products_cost)}}</p>
            @if($order->discount_amount>0)
                <p>{!!$order->getDiscountLabel()!!}
                    : {{StoreHelper::formatPrice($order->discount_amount)}}</p>
            @endif
            @if($order->shipping_method_id>0)
                <p>{{ __('store.order.shipping_cost') }}
                    :
                    <x-fromsky_store-shipping-cost-label :amount="$order->shipping_cost"/>
                </p>
            @endif
            @if($order->payment_fee>0)
                <p>{{ $order->payment_method_display }}
                    : {{StoreHelper::formatPrice($order->payment_fee)}}</p>
            @endif

            <p>{{ __('store.cart.total') }}&nbsp;({{ __('store.cart.with_tax') }}): {{ StoreHelper::formatPrice($order->total_cost) }}</b></p>
        </td>
    </tr>
    </tfoot>
</table>
