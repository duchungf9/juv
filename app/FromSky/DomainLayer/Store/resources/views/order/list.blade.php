<h3 class="text-muted">{{__('store.dashboard.orders')}}</h3>
<div class="bow-shadow-bordered">
    @if($orders->count())
        <table class="table table-bordered table-striped table-hover orders-resume">
            <thead class="thead-dark">
            <tr>
                <th>{{__('store.order.number')}}</th>
                <th class="d-none d-md-table-cell">{{__('store.order.discount.title')}}</th>
                <th class="d-none d-md-table-cell">{{__('store.dashboard.table.products')}}</th>
                <th style="width:100px" class="text-center">{{__('store.dashboard.table.total')}}</th>
                <th class="d-none d-md-table-cell">{{__('store.dashboard.table.payment')}}</th>
                <th class="text-center">{{__('store.dashboard.table.view')}}</th>
                <th class="text-center">{!! __('store.dashboard.table.resend_email')!!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $_order)
                <tr>
                    <td>{{$_order->order_reference}}<br>
                        {{Carbon::parse($_order->created_at)->format('d/m/Y')}} - {{Carbon::parse($_order->created_at)->format('H:i:s')}}
                    </td>
                    <td class="d-none d-md-table-cell">
                        {!!  $_order->coupon_display !!}<br>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <ul class="list-unstyled">
                            @foreach ($_order->order_items as $_item)
                                <li>{{$_item->quantity}} x {{$_item->product_description}} ({{StoreHelper::formatPrice($_item->total_price)}})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">{{StoreHelper::formatPrice($_order->total_cost)}}</td>
                    @if ($_order->payment)
                        <td class="d-none d-md-table-cell">
                            {{$_order->payment->payment_method->title}} -
                            @if ($_order->payment->is_paid)
                                {{__('store.payment.paid')}}
                            @else
                                {{__('store.payment.unpaid')}}
                            @endif
                        </td>
                    @else
                        <td class="d-none d-md-table-cell">
                            <a class="btn btn-primary btn-sm" href="{{$_order->getPermalink()}}">
                                {{__('store.payment.pay')}}
                            </a>
                        </td>
                    @endif
                    <td class="text-center">
                        <a href="{{route('order.detail',['order' =>$_order->token ])}}">{{icon('fas fa-eye')}}</a>
                    </td>
                    <td class="text-center">
                        <a href="#" onclick="sendOrderNotification('{{$_order->token}}');return false">{{icon('fas fa-envelope')}}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <a href="{{route('shop.index')}}" class="h4 text-color-6">{{__('store.dashboard.orders_empty')}}</a>
    @endif
</div>
