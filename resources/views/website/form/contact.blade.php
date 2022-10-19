
@if (session('success'))
    <x-ui.alert class="relative px-3 py-3 mb-4 border rounded alert-color-4  flex items-center" >
        {{icon('check-circle', 'fa-2x flex-shrink-0 me-2')}}
        <div>{!! session('success') !!}</div>
    </x-ui.alert>
@else
    @if ($errors->any())
        <x-ui.alert  class='bg-red-200 border-red-300 text-red-800  flex items-center'>
            {{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
            <div>
            @foreach ( $errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            </div>
        </x-ui.alert>
    @endif

{{ Form::open(['id' => 'form-contact', 'action' => '\App\FromSky\Website\Controllers\WebsiteFormController@getContactUsForm']) }}
<div class="flex flex-wrap  g-3">

    @if(isset($product))
        <div class="w-full">
                <x-website.ui.input type="hidden" value="{{$product->id}}" for="request_product_id" placeholder="{{ __('website.name') }}"/>
            {!! __('website.message.product_request') !!}
            <mark>{{$product->title}}</mark>
        </div>
    @endif

    <div class="w-full sm:w-1/2 pr-4 pl-4">
        <x-website.ui.input for="name" placeholder="{{ __('website.name') }} *" required/>
    </div>
    <div class="w-full sm:w-1/2 pr-4 pl-4">
        <x-website.ui.input for="surname" placeholder="{{ __('website.surname') }} *" required/>
    </div>
    <div class="w-full sm:w-1/2 pr-4 pl-4">
        <x-website.ui.input type="email" for="email" placeholder="{{ __('website.email') }} *" required/>
    </div>
    <div class="w-full sm:w-1/2 pr-4 pl-4">
        <x-website.ui.input for="company" placeholder="{{ __('website.employer') }} " />
    </div>
    <div class="w-full">
        <x-website.ui.input for="subject" placeholder="{{ __('website.subject') }} *" required/>
    </div>
    <div class="w-full">
		<x-website.ui.textarea for="message" placeholder="{{ __('website.message_email') }} *" rows="5" required/>
    </div>
    <div class="w-full sm:w-full pr-4 pl-4">
        <x-website.widgets.privacy-message/>
    </div>

    <div class="w-full sm:w-1/2 pr-4 pl-4 ">
		<button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">{{ __('website.send') }}</button>
    </div>
</div>
{{ Form::close() }}
@endif

@section('headerjs')
    @parent
    @include('website.partials.widgets_captcha')
@endsection

@section('footerjs')
    @parent
    @if (data_get($site_settings,'captcha_site'))
        <script>
            $(function() {
                App.validateCaptcha('{{data_get($site_settings,'captcha_site')}}', 'contact', '#form-contact');
            });
        </script>
    @endif
@endsection
