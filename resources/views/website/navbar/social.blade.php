@foreach ($socials as $_social)
	<li class=" nav-social">
		<a class="inline-block py-2 px-4 no-underline" href="{{$_social->link}}" title="{{$_social->title}}">
			{{icon($_social->icon, 'fab')}}
		</a>
	</li>
@endforeach
