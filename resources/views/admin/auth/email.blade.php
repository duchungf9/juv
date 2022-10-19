@extends('admin.service')
<!-- Main Content -->
@section('content')
	<main id="login-main">
		<div id="login-block">
			<div class="card">
				<img src="{!! asset(config('fromSky.admin.path.assets').'cms/images/logo.png')!!}" alt="CMS Login">
				<hr>

				@if (session('status'))
					<x-ui.alert class="text-center alert-success d-flex align-items-center" >
						{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
						<div>{!! session('status') !!}</div>
					</x-ui.alert>
				@endif
				@if ($errors->has('email'))
					<x-ui.alert class="text-center alert-success d-flex align-items-center" >
						{{icon('exclamation-circle', 'fa-2x flex-shrink-0 me-2')}}
						<div>{{ $errors->first('email') }}</div>
					</x-ui.alert>
				@endif
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/email') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="col-12">
							<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="E-Mail Address" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-12">
							<button type="submit" class="btn btn-block btn-primary">
								{{ trans('message.password_sent_reset_link') }}
							</button>
						</div>
					</div>
					<a href="{{ URL::to('/admin/login/') }}">Login</a>
				</form>
			</div>
		</div>
		@include('admin.footer')
	</main>
@endsection
