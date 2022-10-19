@if ($errors->any())
	<x-ui.alert class="text-center alert-color-4 flex items-center" >
		{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
		<div>
			@foreach ( $errors->all() as $error)
				<div>{{ $error }}</div>
			@endforeach
		</div>
	</x-ui.alert>
@endif
@if(session('status'))
<x-ui.alert class="text-center alert-color-4 flex items-center" >
	{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
	<div>{!! session('status') !!}</div>
</x-ui.alert>
@endif

<form method="POST" action="{{ url_locale('/password/email') }} " class="flex flex-wrap  gy-4">
	{{ csrf_field() }}
	<div class="w-full">
		<x-website.ui.input type="email" placeholder="{{ __('message.password_forgot_enter_email') }}" enableError="{{false}}" for="email" />
	</div>
	<div class="w-full d-grid gap-2 sm:flex sm:justify-end ">
		<button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600">
			{{ trans('message.password_sent_reset_link') }}
		</button>
	</div>
</form>