@php
	if (isset($pageConfig))
		$current_model = $pageConfig['model'];
	else
		$current_model = false;
@endphp
<header class="header">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="main">
		<a id="sidebar-toggle" href="#sidebar" class="nav-toggle">
			{{icon('bars', 'fa-2x')}}
		</a>
		<a class="logo" href="/{{config('cms.admin_path')}}">
			<img src="{!! asset(config('fromSky.admin.path.assets').'cms/images/logo-white.png')!!}" alt="CMS Login" class="img-fluid">
		</a>
		<a id="navbar-toggle" href="#navbar" class="nav-toggle">
			{{icon('bars', 'fa-2x')}}
		</a>
	</div>

	<!-- Navbar Right -->
	<nav id="navbar" class="nav right">
		<ul>
			@if (Auth::guard('admin')->check())
				@if(Auth::guard('admin')->user()->hasRole('su') || Auth::guard('admin')->user()->hasRole('admin'))
					<li>
						<a href="#" class="nav-sub-toggle">
							Cache {{icon('caret-down', 'dropdown-icon')}}
						</a>
						<ul class="nav-sub">
							<li>
								<a href="javascript:void(0);" onclick="removeCache('Website')">
									{{icon('user-circle')}} Remove Cache Website
								</a>
							</li>
							<li>
								<a href="javascript:void(0);" onclick="removeCache('Admin')">
									{{icon('user-circle')}} Remove Cache Admin
								</a>
							</li>
						</ul>
					</li>
				@endif
				@if (Auth::guard('admin')->user()->hasRole('su'))
					<li>
						<a href="#" class="nav-sub-toggle">
							{{trans('admin.label.tools')}}{{icon('caret-down', 'dropdown-icon')}}
						</a>
						<ul class="nav-sub">
							<li>
								<a href="{{ ma_get_admin_list_url('adminuser') }}">
									{{icon('user-circle')}}{{trans('admin.models.adminusers')}}
								</a>
							</li>
							<li>
								<a href="{{ ma_get_admin_list_url('template') }}">
									{{icon('puzzle-piece')}}{{trans('admin.models.templates')}}
								</a>
							</li>
							<li>
								<a href="{{ ma_get_admin_list_url('country') }}">
									{{icon('globe')}}{{trans('admin.models.countries')}}
								</a>
							</li>
							<li>
								<a href="{{ ma_get_admin_list_url('setting') }}">
									{{icon('wrench')}}{{trans('admin.models.settings')}}
								</a>
							</li>
							<li>
								<a href="{{ ma_get_admin_list_url('role') }}">
									{{icon('users')}}{{trans('admin.models.roles')}}
								</a>
							</li>
						</ul>
					</li>
				@endif
				<li>
					<a href="#" class="nav-sub-toggle">
						{{Auth::guard('admin')->user()->fullname}}{{icon('caret-down', 'dropdown-icon')}}
					</a>
					<ul class="nav-sub">
						@if (Auth::guard('admin')->check())
							<li>
								<a href="{{ URL::to(config('cms.admin_path').'/edit/adminusers/'.Auth::guard('admin')->user()->id) }}">
									{{icon('user')}}{{trans('admin.label.profile')}}
								</a>
							</li>
							<li>
								<a href="{{ URL::to(config('cms.admin_path').'/logout') }}">
									{{icon('sign-out-alt')}}{{trans('admin.label.logout')}}
								</a>
							</li>
						@else
							<li>
								<a href="{{ URL::to(config('cms.admin_path').'/login') }}">
									{{icon('sign-in')}}{{trans('admin.label.login')}}
								</a>
							</li>
						@endif
					</ul>
				</li>
			@endif
		</ul>
	</nav>
	@if (Auth::guard('admin')->check())

		<nav id="sidebar" class="nav vertical left">
			<ul class="body">
				<li>
					<a href="{{ URL::to('/') }}" target="_new" class="highlight">
						{{icon('globe')}}{{trans('admin.label.go_to_site')}}
					</a>
				</li>
				<li>
            <a href="{{URL::to('/'.config('cms.admin_path'))}}" class="highlight">
						{{icon('th')}}{{trans('admin.label.dashboard')}}
					</a>
				</li>
				<side-bar-component></side-bar-component>
				{{--

				@foreach(config('fromSky.admin.list.section') as $_code => $_section)
					@if (isset($_section['menu']['top-bar']['show']) && $_section['menu']['top-bar']['show']==true  && Auth::guard('admin')->user()->canViewSection($_section))
						@if (isset($_section['menu']['top-bar']['submodel']))
							<li>
								<a href="#" class="nav-sub-toggle">
									{{icon($_section['icon'])}}{{ trans('admin.models.'.$_code) }}{{icon('caret-down', 'dropdown-icon')}}
								</a>
								<ul class="nav-sub">
									<li>
										<a href="{{ ma_get_admin_list_url($_section['model']) }}" class="{{($_section['model'] == $current_model)? 'current': ''}}">
											{{icon($_section['icon'])}}{{ trans('admin.models.'.$_code) }}
										</a>
									</li>
									@if (isset($_section['menu']['top-bar']['submodel']))
										@foreach($_section['menu']['top-bar']['submodel'] as $_submodel_code => $_submodel)
											<li>
												<a href="{{ma_get_admin_list_url($_submodel['model']) }}" class="{{($_submodel['model'] == $current_model)? 'current': ''}}">
													{{icon($_section['icon'])}}{{ucfirst(trans('admin.models.'.$_submodel_code))}}
												</a>
											</li>
										@endforeach
									@endif
								</ul>
							</li>
						@else
							<li>
								<a href="{{ ma_get_admin_list_url($_section['model']) }}" class="{{($_section['model'] == $current_model)? 'current': ''}}">
									{{icon($_section['icon'])}} {{ trans('admin.models.'.$_code) }}
								</a>
							</li>
						@endif
					@endif
				@endforeach
				--}}
			</ul>
			<div class="footer">
				{{config('fromSky.admin.option.title')}} {{ App::VERSION() }} - {{phpversion()}}
			</div>
		</nav>
	@endif
</header>
