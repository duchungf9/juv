<div class="language_header" data-bs-toggle="collapse" href="#{{$target}}">
	<div class="flag">
		<img src="{{asset(config('fromSky.admin.path.assets').'website/images/flags/'.$locale.'.png')}}" alt="{{$label}}">
	</div>
	<div class="title">
		{{$label}}
	</div>
	{{icon('caret-down', 'dropdown-icon')}}
</div>
