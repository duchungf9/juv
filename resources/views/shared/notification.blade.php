@if (session('success'))
	<div class="alert-success alert-dismissible d-flex align-items-center alert" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('check-circle', 'fa-2x flex-shrink-0 me-2')}}
		<div>{!! session('success') !!}</div>
	</div>
@endif
@if ($errors->any())
	<div class="alert-danger alert-dismissible d-flex align-items-center alert" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<div>
			@foreach ( $errors->all() as $error)
				<p>{{ $error }}</p>
			@endforeach
		</div>
	</div>

@endif
@if (session('error'))
	<div class="alert-danger alert-dismissible d-flex align-items-center alert" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<p>{!! session('error') !!}</p>
	</div>
@endif
@if (session('warning'))
	<div class="alert-warning alert-dismissible d-flex align-items-center alert" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<p>{!! session('warning') !!}</p>
	</div>
@endif
@if (session('status'))
	<div class="alert-info alert-dismissible d-flex align-items-center alert" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<p>{!! session('status') !!}</p>
	</div>
@endif
