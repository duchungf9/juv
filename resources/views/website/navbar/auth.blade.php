@if(FromSkyFeatures::hasReservedArea())

	@if (!Auth::guard()->check())
		<li class="group flex relative bg-lime-600">
			<a class="flex px-2 h-10 items-center hover:bg-slate-800" href="{{url_locale('users/login')}}" title="">{{trans('auth.login')}}</a>
		</li>
	@else
		<li class="group flex relative">
			<a class="flex px-2 h-10 items-center hover:bg-slate-800 {{!empty($active)?'bg-orange-400':''}}" href="{{$page->nav_link}}" title="{{$page->alt_seo_title}}">{{$page->nav_title}} {{icon('chevron-down ms-1')}}</a>
			<ul class="absolute top-full left-0 group-hover:block hidden list-none p-0 m-0 bg-gray-500 w-52">
				@if(StoreFeatures::isStoreEnabled())				
				<li>
					<a class="flex px-2 h-10 items-center hover:bg-slate-800 hover:text-white" href="{{url_locale('users/dashboard')}}">
						{{icon('list')}} {{trans('auth.dashboard')}}
					</a>
				</li>
				@endif
				<li>
					<a class="flex px-2 h-10 items-center hover:bg-slate-800 hover:text-white" href="{{url_locale('users/profile')}}">
						{{icon('user')}} {{trans('auth.profile')}}
					</a>
				</li>
				<li>
					<a class="flex px-2 h-10 items-center hover:bg-slate-800 hover:text-white" href="{{url_locale('logout')}}">
						{{icon('sign-out-alt')}} {{trans('auth.logout')}}
					</a>
				</li>
			</ul>
		</li>
		
	@endif
@endif