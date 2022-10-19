@extends('website.app')
@section('content')
	<x-website.partials.page-header  :title="trans('message.password_reset')"/>
	<section>
        <div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="w-full lg:w-2/5 pr-4 pl-4 mx-auto auth-box">
					<h2 class="text-blue-600 text-center auth-box-title">{{ trans('message.password_reset') }}</h2>
					<div class="auth-box-content">
					@include('website.auth.form.reset')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
