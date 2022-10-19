@if($product->full_price)
    <del {{ $attributes->merge(['class' => $type.'-price-full']) }}>{{ StoreHelper::formatPrice($product->full_price)}}</del>
@endif
<span  {{ $attributes->merge(['class' => $type.'-price-final']) }}>{{ StoreHelper::formatProductPrice($product) }}</span>

