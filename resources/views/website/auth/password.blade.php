@extends('website.app')
@section('content')
	<x-website.partials.page-header  :title="__('message.password_forgot')"/>
	<section>
        <div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="w-full lg:w-2/5 pr-4 pl-4 mx-auto auth-box gy-2">
					<div class="auth-box-content">
						<h2 class="text-blue-600 text-center mb-4">{{ __('message.password_forgot') }}</h2>
						@include('website.auth.form.password')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
