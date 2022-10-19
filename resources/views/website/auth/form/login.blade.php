
<form class="login-form flex flex-wrap  g-4" method="post" action="{{url_locale('users/login')}}">
	{!! csrf_field() !!}
	@if (isset($redirectTo))
		<input type="hidden" name="redirectTo" value="{{$redirectTo}}">
	@endif
	<div class="w-full">
		<x-website.ui.input type="email" for="email" placeholder="{{ __('website.email') }}*" required />
	</div>
	<div class="w-full">
    	<x-website.ui.input type="password" for="password" value="" autocomplete="off" placeholder="{{__('website.password')}}*" required/>
	</div>

	<div class="login-form-support flex flex-wrap justify-between">
		<x-website.ui.checkbox for="remember">
			{{ __('message.remember_me') }}
		</x-website.ui.checkbox>
		<a class="text-color-4" href="{{ url_locale('/password/reset') }}">
				{{ __('message.password_forgot_your') }}
		</a>
		
	</div>

	<div class="relative flex-grow max-w-full flex-1 px-4">
		<button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600 w-full ">
			{{ __('message.sign_in') }}
		</button>
	</div>
	@if(data_get($site_settings,'enable_social_auth') )

		<x-fromsky_social-login-component :label="trans('auth.social_login')" :redirectTo="$redirectTo??''"/>
	@endif

	@if (!isset($with_register))
		<div class="login-form-not-registered flex justify-center">
			{{ __('message.not_registered') }}
			<a class="ms-1 text-accent" href="{{ url_locale('/register') }}">{{ __('message.new_user') }}
			</a>
		</div>
	@endif
</form>
