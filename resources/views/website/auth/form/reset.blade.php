<form class="flex flex-wrap  d-grid gy-3" role="form" method="POST" action="{{url_locale('/password/reset')}}">
	{{ csrf_field() }}
	<x-website.ui.input type="hidden" for="token" value="{{ $token }}"/>
	<div class="w-full">
		<x-website.ui.input type="email" for="email"  autocomplete="off" placeholder="{{ trans('website.email') }}"/>
	</div>
	<div class="w-full">
		<x-website.ui.input type="password" for="password" placeholder="{{trans('website.password')}}"/>
	</div>
	<div class="w-full">
		<x-website.ui.input type="password" for="password_confirmation" placeholder="{{ trans('message.password_confirm') }}"/>
	</div>
	<div class="w-full">

		<div class="relative px-3 py-3 mb-4 border rounded alert-color-4">
			{{trans('website.message.password')}}
		</div>
	</div>
	<div class="w-full d-grid gap-2 sm:flex sm:justify-end">
		<button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-green-500 text-white hover:bg-green-600">{{ trans('message.password_reset') }}</button>
	</div>
</form>
