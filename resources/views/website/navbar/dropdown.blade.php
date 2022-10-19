<li class="group flex relative px-[20px] z-50" data-slug="{{$page->slug}}">
	<a class="flex relative py-[10px] uppercase whitespace-nowrap text-md text-xam items-center leading-[28px] font-normal hover:text-red hover:drop-shadow-[1px_0_0_currentColor] {{!empty($active)?'active':''}}"
	   href="{{$page->nav_link}}"
	   title="{{$page->alt_seo_title}}">{{$page->nav_title}}
	</a>
	<ul class="border-t-[1px] border-[#DADCE0] group-hover:block hidden absolute top-[48px] left-0 bg-white w-60">
		@foreach ($children as $index => $child)
			{{-- @php
				$active = (!empty($current_page) && $child->id == $current_page->id) ? 'active' : '';
			@endphp --}}
			<li>
				<a href="{{$child->nav_link}}" title="{{$child->alt_seo_title}}" class="hover:text-red uppercase block py-[10px] pl-[20px] text-md leading-[28px] border-solid border-b-[1px] border-[#DADCE0]">
					{{$child->nav_title}}</a>
			</li>
		@endforeach
	</ul>
</li>
