@extends('website.app')
@section('content')
	<x-website.partials.page-header  :title="$page->menu_title"/>
	<section>
        <div class="container mx-auto sm:px-4">
			<div class="flex flex-wrap ">
				<div class="w-full md:w-1/2 pr-4 pl-4 lg:w-2/5 pr-4 pl-4 xl:w-2/5 pr-4 pl-4 mx-auto login-box">
					<div class="login-box-content">
						<h3 class="login-box-title text-blue-600 text-center">{{ $page->title }}</h3>
						@include('website.auth.form.login')
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
