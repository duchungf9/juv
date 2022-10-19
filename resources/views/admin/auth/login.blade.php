@extends('admin.service')
@section('content')
	<main id="login-main">
		<div id="login-block">
			<div class="card">
				<img src="{!! asset(config('fromSky.admin.path.assets').'cms/images/logo.png')!!}" alt="CMS Login">

				<hr>
				<form method="post">
					<h3>Login admin</h3>
					@if (count($errors) > 0)
						<x-ui.alert class="alert-danger d-flex align-items-center" >
							{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
							<div>
								@foreach ($errors->all() as $error)
									<p>{{ $error }}</p>
								@endforeach
							</div>
						</x-ui.alert>
					@endif
					@if(session()->has("err_mess"))
						<x-ui.alert class="alert-danger d-flex align-items-center" >
							{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
							<div>

								<p>{{ session()->get("err_mess") }}</p>

							</div>
						</x-ui.alert>
					@endif

					{!! csrf_field() !!}
                    <div class="form-group">
						<input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="E-Mail Address">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="Password">
					</div>
					<div class="form-group row d-flex align-items-center d-grid gy-2">
						<div class="col-12 col-sm-6 order-2 order-sm-1">
							<div class="form-check custom-checkbox">
								<input type="checkbox" name="remember" class="form-check-input" id="remember">
								<label class="form-check-label custom-control-label  text-start" for="remember">@lang('message.remember_me')</label>
							</div>
						</div>
						<div class="col-12 col-sm-6 order-1 order-sm-2">
							<a href="/social_admin/google" class="btn" style="background: #F13C36FF;color:#fff;padding: 5px 10px">Login with google </a>
							<button type="submit" class="btn btn-primary w-100">Login</button>
						</div>
					</div>
					@if(isset($_GET['github']) && $_GET['github'] == 1)
					<div class="form-group row d-flex align-items-center d-grid gy-2">
						<div class="col-12 col-sm-6 order-2 order-sm-1">
							<div class="form-check custom-checkbox">
								<input type="checkbox" name="remember" class="form-check-input" id="remember">
								<label class="form-check-label custom-control-label  text-start" for="remember">@lang('message.remember_me')</label>
							</div>
						</div>
						<div class="col-12 col-sm-6 order-1 order-sm-2">
							<a href="/social_admin/github" class="btn" style="background: #F13C36FF;color:#fff;padding: 5px 10px">Login with github </a>
														<button type="submit" class="btn btn-primary w-100">Login</button>
						</div>
					</div>
					@endif
					<a href="{{ URL::to('/admin/password/reset/') }}">
						@lang('message.password_forgot')
					</a>

				</form>
			</div>
		</div>
		@include('admin.footer')
	</main>
@endsection
