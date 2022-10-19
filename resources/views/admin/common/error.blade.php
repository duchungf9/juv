@if (Session::has('flash_message'))
<x-ui.alert class="flash alert-info {{ Session::has('flash_message_important') ? 'alert-important':''}} pf25 mb15" >
	{{ session('flash_message') }}
</x-ui.alert>
@endif
@if (Session::has('message'))
	<x-ui.alert class="flash alert-info alert-dismissible {{ Session::has('message_important') ? 'alert-important':''}} pf25 mb15">
		{{ session('message') }}
	</x-ui.alert>
@endif
@if ($errors->any())
	<x-ui.alert  class='alert-danger alert-dismissible d-flex align-items-center'>
		{{icon('times-circle', 'fa-2x flex-shrink-0 me-2')}}
		<div>
			@foreach ( $errors->all() as $error)
				<p>{{ $error }}</p>
			@endforeach
		</div>
	</x-ui.alert>
@endif

@if (session('status'))
<x-ui.alert class="text-center alert-success">
	{{ session('status') }}
</x-ui.alert>
@endif
