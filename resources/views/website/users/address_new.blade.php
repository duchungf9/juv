@extends('website.app')
@section('content')
    <x-website.partials.page-header :title="trans('store.address.new')"/>
    <section>
        <div class="container mx-auto sm:px-4">
            @include('flash::notification')

            <div class="w-full lg:w-2/3 pr-4 pl-4 mx-auto login-box">
                <h2 class="login-box-title text-blue-600 text-center">{{ trans('store.address.new') }}</h2>
                <div class="login-box-content">
                    <form class="" action="" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="previous" value="{{$previous}}">
                        <div class="flex flex-wrap  mb-4">

                            <div class="w-full sm:w-2/3 pr-4 pl-4 mb-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="text" name="street" value="{{ old('street') }}"
                                       placeholder="{{trans('store.address.fields.street')}}" required>
                            </div>
                            <div class="w-full sm:w-1/3 pr-4 pl-4 mb-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="text" name="number" value="{{ old('number') }}"
                                       placeholder="{{trans('store.address.fields.number')}}" required>
                            </div>

                            <div class="w-full sm:w-2/3 pr-4 pl-4 mb-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="text" name="city" value="{{ old('city') }}"
                                       placeholder="{{trans('store.address.fields.city')}}" required>
                            </div>

                            <div class="w-full sm:w-1/3 pr-4 pl-4 mb-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="text" name="zip_code" value="{{ old('zip_code') }}"
                                       placeholder="{{trans('store.address.fields.zip_code')}}" required>
                            </div>


                            <div class="w-full sm:w-1/2 pr-4 pl-4 mb-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="text" name="province" value="{{ old('province') }}"
                                       placeholder="{{trans('store.address.fields.province')}}" required>
                            </div>
                            <div class="w-full sm:w-1/2 pr-4 pl-4 mb-4">
                                <select class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" name="country_id" required>
                                    @foreach ($countries as $_country)
                                        <option value="{{$_country->id}}"
                                                @if(old('country-id') == $_country->id) selected="true" @endif>{{$_country->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full sm:w-1/2 pr-4 pl-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded mb-4" type="text" name="phone" value="{{ old('phone') }}"
                                       placeholder="{{trans('store.address.fields.phone')}}">
                            </div>
                            <div class="w-full sm:w-1/2 pr-4 pl-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded mb-4" type="text" name="mobile" value="{{ old('mobile') }}"
                                       placeholder="{{trans('store.address.fields.mobile')}}">
                            </div>
                            <div class="w-full sm:w-1/2 pr-4 pl-4">

                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded mb-4" type="email" name="email"
                                       value="{{ (old('email'))? old('email') : auth()->guard()->user()->email}}"
                                       placeholder="{{trans('store.address.fields.email')}}">
                            </div>
                            <div class="w-full sm:w-1/2 pr-4 pl-4 mb-4">
                                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded" type="text" name="vat" value="{{ old('vat') }}"
                                       placeholder="{{trans('store.address.fields.vat')}}">
                            </div>
                        </div>
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                            {{trans('store.address.save')}}
                        </button>
                    </form>
                </div>
            </div>



        </div>
    </section>

@endsection
