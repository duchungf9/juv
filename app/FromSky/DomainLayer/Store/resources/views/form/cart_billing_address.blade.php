<div class="row my-2">
    <div class="col-12">

        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="shippingAsBilling" value="1" id="shippingAsBilling"
                    {{ ($cart->billing_address_id)?"checked":false }} onclick="($(this).prop('checked'))?$('#billing_address_box').show():$('#billing_address_box').hide();">
            <label class="custom-control-label" for="shippingAsBilling">
                {{trans('store.order.billing_different_address')}}
            </label>
            <x-website.ui.input-error-label class="pt-1"
                    for="billing_shippingAsBilling"></x-website.ui.input-error-label>
        </div>
    </div>
</div>
<div class="row gy-3 mb-5"
        id="billing_address_box" {!! ($cart->hasBillingAddress())? ' ' : ' style="display:none"' !!}>
    <div class="col-12 mt-4 ">
        <h3>{{trans('store.order.billing')}}</h3>
    </div>
    <div class="col-12 col-md-6">
        <input type="text" class="form-control" placeholder="{{ trans('website.firstname') }}" name="billing_firstname"
                value="{{ old('billing_billing_firstname')?? $cart->billing_firstname }}" srequired>
        <x-website.ui.form-error-label class="pt-1" field="billing_firstname"/>
    </div>
    <div class="col-12 col-md-6">
        <input type="text" class="form-control" placeholder="{{ trans('website.lastname') }}"
                name="billing_lastname"
                value="{{ old('billing_lastname')??$cart->billing_lastname }}" srequired>
        <x-website.ui.form-error-label class="pt-1" field="billing_lastname"/>

    </div>

    <div class="col-12 col-sm-8 ">
        <input class="form-control" type="text" name="billing_street"
                value="{{ old('billing_street') ?? optional($cart->billing_address)->street  }}"
                placeholder="{{trans('store.address.fields.street')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="billing_street"/>
    </div>
    <div class="col-12 col-sm-4 ">
        <input class="form-control" type="text" name="billing_number"
                value="{{ old('billing_number') ??  optional($cart->billing_address)->number }}"
                placeholder="{{trans('store.address.fields.number')}} *">
        <x-website.ui.form-error-label class="pt-1" field="billing_number" srequired/>
    </div>

    <div class="col-12 col-sm-8 ">
        <input class="form-control" type="text" name="billing_city"
                value="{{ old('billing_city') ??  optional($cart->billing_address)->city }}"
                placeholder="{{trans('store.address.fields.city')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="billing_city" srequired/>
    </div>

    <div class="col-12 col-sm-4 ">
        <input class="form-control" type="text" name="billing_zip_code"
                value="{{ old('billing_zip_code') ??  optional($cart->billing_address)->zip_code }}"
                placeholder="{{trans('store.address.fields.zip_code')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="billing_zip_code" required/>

    </div>


    <div class="col-12 col-sm-6 ">
        <input class="form-control" type="text" name="billing_province"
                value="{{ old('billing_province') ?? optional($cart->billing_address)->province  }}"
                placeholder="{{trans('store.address.fields.province')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="billing_province" srequired/>
    </div>
    <div class="col-12 col-sm-6 ">
        <select class="form-control" name="billing_country_id" required>
            @foreach ($countries as $_country)
                <option value="{{$_country->id}}"
                        @if(old('billing_country-id') == $_country->id || optional($cart->billing_address)->country_id ===$_country->id) selected="{{true}}" @endif>{{$_country->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-sm-6 ">
        <input class="form-control" type="text" name="billing_phone"
                value="{{ old('billing_phone') ?? optional($cart->billing_address)->phone }}"
                placeholder="{{trans('store.address.fields.phone')}} *">
        <x-website.ui.form-error-label class="pt-1" field="billing_phone" srequired/>
    </div>

    <div class="col-12 col-sm-6 ">

        <input class="form-control" type="email" name="billing_email"
                value="{{ (old('billing_email')) ?? $cart->billing_email }}"
                placeholder="{{trans('store.address.fields.email')}} *">
        <x-website.ui.form-error-label class="pt-1" field="billing_email" srequired/>
    </div>
    <div class="col-12 col-sm-6 ">
        <input class="form-control" type="text" name="billing_vat"
                value="{{ old('billing_vat') ?? optional($cart->billing_address)->vat }}"
                placeholder="{{trans('store.address.fields.vat')}}">
    </div>
</div>
