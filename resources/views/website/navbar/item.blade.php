<li class="group flex relative px-[12px] lg:px-[20px]" data-slug="{{$page->slug}}">
	<a class="flex relative lg:py-[10px] py-[16px] uppercase whitespace-nowrap text-sm lg:text-md text-xam items-center lg:leading-[28px] leading-[18px] font-bold lg:font-normal hover:text-red hover:drop-shadow-[1px_0_0_currentColor] {{!empty($active)?'active':''}}"
	   href="{{$page->nav_link}}"
	   title="{{$page->alt_seo_title}}">{{$page->nav_title}}
	</a>
</li>
