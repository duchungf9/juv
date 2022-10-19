<div class="card cart-summary box-shadow p-2">
    <div class="cart-summary-line cart-item">
        <span class="label">{{ $cart->cart_items_count }} {{ __('store.cart.number_of_items') }} </span>
        <span class="value"></span>
    </div>
    <!-- Card summary details -->
    <div class="cart-summary-detail mb-2">
        <a class="text-accent d-flex justify-content-between" data-bs-toggle="collapse"
                href="#cartSummaryDetail"
                aria-expanded="false" aria-controls="cartSummaryDetail">
            {{ __('store.cart.show_detail') }} <span><i class="fas fa-chevron-down pt-1"></i></span>
        </a>
        <div class="collapse mt-2" id="cartSummaryDetail">
            @foreach($cart->cart_items()->get() as $item)
                <div class="d-flex mb-2 justify-content-start">
                    <div class="flex-shrink-0">
                        <img class="img-fluid"
                                src="{{ $item->product->getThumbImage() }}"
                                alt="{{$item->product->title}}">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <span class="product-name d-flex ">{{$item->product->title}}</span>
                        <div class="d-flex justify-content-between">
                            <div class="product-prince-info">
                                <x-fromsky_store-product-display-price
                                        :product="$item->product"
                                        :type="'product-price'"/>
                                <div class="product-quantity text-secondary">x {{$item->quantity}}</div>
                            </div>
                            <div class="product-price font-weight-bold">
                                {{StoreHelper::formatPrice($item->product->price * $item->quantity)}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="cart-summary-line cart-product-total">
        <span class="label">{{ __('store.order.products_cost') }}</span>
        <span class="value">{{ StoreHelper::formatCartTotal($cart) }}</span>
    </div>
    @if($cart->getDiscountTotalAmount())
        <div class="cart-summary-line cart-discount">
            <span class="label">{{ __('store.order.discount.title') }}<br><strong>{{ $cart->discount_label }}</strong></span>
            <span class="value">{{ StoreHelper::formatPrice($cart->getDiscountTotalAmount()) }}<br><a
                        href="" @click.prevent="deleteCartCoupon"
                        class="text-danger d-none">{{ __('store.order.discount.delete') }}</a></span>
        </div>
    @endif
    @if($cart->displayShippingCost())
        <div class="cart-summary-line cart-ship">
            <span class="label">{{ __('store.order.shipping_cost') }}</span>
            <span class="value"><x-fromsky_store-shipping-cost-label :amount="$cart->shipping_cost"/></span>
        </div>
    @endif
    @if($cart->getPaymentFeeAmount())
        <div class="cart-summary-line cart-payment-fee">
            <span class="label">{{optional($cart->payment_method)->title }}</span>
            <span class="value">{{ StoreHelper::formatPrice($cart->getPaymentFeeAmount()) }}</span>
        </div>
    @endif
    <div class="cart-summary-totals">
        <div class="cart-summary-line cart-total">
            <span class="label">{{ __('store.cart.total') }}&nbsp;({{ __('store.cart.with_tax') }})</span>
            <span class="value">{{ StoreHelper::formatPrice($cart->displayTotal()) }}</span>
        </div>
    </div>
</div>
<!-- Card Discount -->
<coupon-component></coupon-component>


