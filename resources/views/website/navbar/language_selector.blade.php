<li class="group flex relative bg-blue-500">
	<a class="flex px-2 h-10 items-center hover:bg-slate-800" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="dd_locale_selector" title="">
		{{substr(LaravelLocalization::getSupportedLocales()[LaravelLocalization::getCurrentLocale()]['native'], 0, 3)}} {{icon('chevron-down ms-1')}}
	</a>
	<ul class="absolute top-full left-0 group-hover:block hidden list-none p-0 m-0 bg-gray-500 w-52" aria-labelledby="#dd_locale_selector">
		@foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
			@if (LaravelLocalization::getCurrentLocale() != $localeCode)
				@if ($locale_page && !$locale_page->ignore_slug_translation)
					<li>
						<a class="flex px-2 h-10 items-center hover:bg-slate-800 hover:text-white" href="{{LaravelLocalization::getLocalizedURL($localeCode, $locale_page->getPermalink($localeCode))}}" title="{{$properties['native']}}">
							{{$properties['native']}}
						</a>
					</li>
				@else
					<li>
						<a class="flex px-2 h-10 items-center hover:bg-slate-800 hover:text-white" href="{{LaravelLocalization::getLocalizedURL($localeCode)}}" title="{{$properties['native']}}">
							{{$properties['native']}}
						</a>
					</li>
				@endif
			@endif
		@endforeach
	</ul>
</li>


