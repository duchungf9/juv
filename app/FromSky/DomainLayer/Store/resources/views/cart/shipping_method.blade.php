@if(StoreHelper::isShippingEnabled())
    <h4 class="order-sub-step-title"> {{ trans('store.shipping.method') }}</h4>
    <div class="row">
        <div class="col-12 mb-3">
            @foreach ($shipping_methods() as $_method)
                <div class="form-check mb-2">
                    <input type="radio" required name="shipping_method_id"
                            class="form-check-input"
                            value="{{$_method->id}}" {{($cart->shipping_method_id==$_method->id)?'checked':''}}>
                    <label class="form-check-label" for="shipping_method_id">{{$_method->cart_label}}</label>
                </div>
            @endforeach
            <x-website.ui.form-error-label class="pt-1" field="shipping_method_id" srequired/>
        </div>
    </div>
@else
    <h4 class="text-primary mb-3">{{__('store.shipping.free')}}</h4>
@endif




