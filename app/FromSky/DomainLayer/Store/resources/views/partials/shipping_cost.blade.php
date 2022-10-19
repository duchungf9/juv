@if($amount>0){{StoreHelper::formatPrice($amount)}}@else
    {{__('store.shipping.free_label')}}
@endif
