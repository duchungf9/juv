<h3>{{trans('store.order.shipping')}}</h3>
<div class="row gy-3">

    <div class="col-12 col-md-6">

        <input type="text" class="form-control" placeholder="{{ trans('website.firstname') }} *" name="firstname"
                value="{{ old('firstname')?? $cart->shipment_firstname }}" srequired>
        <x-website.ui.form-error-label class="pt-1" field="firstname"/>

    </div>
    <div class="col-12 col-md-6">

        <input type="text" class="form-control" placeholder="{{ trans('website.lastname') }} *" name="lastname"
                value="{{ old('lastname')??$cart->shipment_lastname }}" srequired>
        <x-website.ui.form-error-label class="pt-1" field="lastname"/>

    </div>

    <div class="col-12 col-sm-8 ">
        <input class="form-control" type="text" name="street"
                value="{{ old('street') ?? optional($cart->shipping_address)->street  }}"
                placeholder="{{trans('store.address.fields.street')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="street"/>
    </div>
    <div class="col-12 col-sm-4">
        <input class="form-control" type="text" name="number"
                value="{{ old('number') ??  optional($cart->shipping_address)->number }}"
                placeholder="{{trans('store.address.fields.number')}} *">
        <x-website.ui.form-error-label class="pt-1" field="number" srequired/>
    </div>

    <div class="col-12 col-sm-8">
        <input class="form-control" type="text" name="city"
                value="{{ old('city') ??  optional($cart->shipping_address)->city }}"
                placeholder="{{trans('store.address.fields.city')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="city" srequired/>
    </div>

    <div class="col-12 col-sm-4">
        <input class="form-control" type="text" name="zip_code"
                value="{{ old('zip_code') ??  optional($cart->shipping_address)->zip_code }}"
                placeholder="{{trans('store.address.fields.zip_code')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="zip_code" srequired/>

    </div>

    <div class="col-12 col-sm-6">
        <input class="form-control" type="text" name="province" value="{{ old('province') ?? optional($cart->shipping_address)->province }}"
                placeholder="{{trans('store.address.fields.province')}} *" srequired>
        <x-website.ui.form-error-label class="pt-1" field="province" srequired/>
    </div>
    <div class="col-12 col-sm-6">
        <select class="form-control" name="country_id">

            @foreach ($countries as $_country)
                <option value="{{$_country->id}}"
                        @if(old('country-id') == $_country->id || optional($cart->shipping_address)->country_id ===$_country->id) selected="true" @endif>
                    {{$_country->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-sm-6">
        <input class="form-control" type="text" name="phone" value="{{ old('phone') ?? optional($cart->shipping_address)->phone  }}"
                placeholder="{{trans('store.address.fields.phone')}} *">
        <x-website.ui.form-error-label class="pt-1" field="phone" srequired/>
    </div>

    <div class="col-12 col-sm-6">
        <input class="form-control" type="email" name="email"
                value="{{ (old('email'))??  $cart->shipment_email}}"
                placeholder="{{trans('store.address.fields.email')}} *">
        <x-website.ui.form-error-label class="pt-1" field="email" srequired/>
    </div>
    <div class="col-12 col-sm-6">
        <input class="form-control" type="text" name="vat" value="{{ old('vat') ?? optional($cart->shipping_address)->vat}}"
                placeholder="{{trans('store.address.fields.vat')}}">
    </div>
</div>