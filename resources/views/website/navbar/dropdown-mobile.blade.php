<li class="relative" data-slug="{{$page->slug}}">
	<a href="{{$page->nav_link}}" title="{{$page->alt_seo_title}}" class="block text-md leading-[28px] py-[10px] border-solid border-b-[1px] border-[#DADCE0]">{{$page->nav_title}}</a>
	<ul class="sub-menu border-t-[1px] border-[#DADCE0] hidden">
		@foreach ($children as $index => $child)
			{{-- @php
				$active = (!empty($current_page) && $child->id == $current_page->id) ? 'active' : '';
			@endphp --}}
			<li><a href="{{$child->nav_link}}" title="{{$child->alt_seo_title}}" class="block py-[10px] pl-[20px] text-md leading-[23px] font-bold border-solid border-b-[1px] border-[#DADCE0]">{{$child->nav_title}}</a></li>
		@endforeach
	</ul>
</li>
