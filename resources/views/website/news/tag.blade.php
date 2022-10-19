@extends('website.app')
@section('bodyBg', 'bg-white')
@section('content')

	<div class="mt-[105px] hidden lg:block"></div>
	<x-website.widgets.banners :template="'banner-top'" :id-banner="data_get($site_settings,'cat_idBannerCenter1')" :code-banner="'cat_idBannerCenter1'" :height="250" :width="970"/>

	<x-website.ui.breadcrumbs class="bg-accent">
		<div class="text-white page-breadcrumb flex items-end">
			<div class="page-breadcrumb__item">{{$tag->title}}</div>
		</div>
	</x-website.ui.breadcrumbs>
	<x-website.news.index :tag="$tag"></x-website.news.index>


	<div class="w-full">
		<div class="container w-full mx-auto">
			<div class="header mb-[20px] pt-[20px] border-b-[1px] hidden lg:block">
				<h1 class="mb-[16px] text-[32px] leading-[37px] text-[#202124] font-bold">{{$tag->title}}</h1>
			</div>
			<div class="flex items-center py-[16px] px-[20px] lg:hidden overflow-auto">
				<a href="" title=""><i class="w-[24px] h-[24px] block bg-[url('../images/icon-home.svg')]"></i></a>
				<span class="w-[1px] h-[24px] bg-[#DADCE0] mx-[20px]"></span>
				<a href="" title="" class="text-sm leading-[18px] font-bold text-red whitespace-nowrap">TIN TỨC</a>
				<a href="" title="" class="text-sm leading-[18px] font-bold text-[#3D4043] pl-[20px] whitespace-nowrap">Tin thị trường</a>
				<a href="" title="" class="text-sm leading-[18px] font-bold text-[#3D4043] pl-[20px] whitespace-nowrap">Kiến thức cơ bản</a>
			</div>
			<div class="flex flex-wrap justify-between">
				<div class="w-full lg:w-3/4 md:px-[15px] lg:px-0 border-b-[1px] border-[#DADCE0]">
					@foreach ($news as $k=>$post)
						@if($k===0)
							<div class="md:pb-[20px] md:border-b-[1px] border-[#DADCE0]">
								<div class="flex flex-wrap bg-[#F1F3F4]">
									<a href="{{ $post->getPermalink() }}" class="lg:w-[530px] md:w-1/2"><img src="{{ImgHelper::get_cached($post->image,config('fromSky.image.thumbnail_cat_big'))}}" class="object-cover w-full" alt="{{ $post->title }}"></a>
									<div class="lg:w-[440px] md:w-1/2 px-[35px] py-[20px] lg:p-[20px]">
										<div class="flex items-center mb-[6px]">
											@foreach($post->getTags() as $tag)
												<a class="bg-[#3474E0] text-[#fff] rounded-[2px] text-xs leading-[14px] px-[6px] py-[3px] mr-[10px]" title="{{$tag->title}}" href="{{$tag->getPermalink()}}">{{$tag->title}}</a>
											@endforeach
										</div>
										<h3 class="mb-[6px] lg:mb-[10px]"><a href="{{ $post->getPermalink() }}" class="lg:text-[32px] lg:leading-[40px] text-lg leading-[28px] text-[#202124] font-bold">{{ $post->title }}</a></h3>
										<p class="text-sm leading-[23px] mb-[6px] lg:mb-[10px]">{{ $post->getExcerpt() }}</p>
										<time class="text-xs leading-[14px] text-[#606368]">{{ Carbon::parse($post->date)->format('d/m/Y') }}</time>
									</div>
								</div>
							</div>
						@else
							<div class="px-[35px] lg:px-0">
								<x-website.news.item :post="$post"></x-website.news.item>
							</div>
						@endif
					@endforeach
				</div>


				<div class="w-full px-[35px] mt-[20px] lg:mt-0 lg:px-0 lg:w-1/4 lg:pl-[20px]">

					<x-website.news.good-news :category="$category"></x-website.news.good-news>

					<x-website.carousels.investment-carousel :class-list="'mt-[20px] border-t-[1px] lg:shadow-[0_0_6px_rgba(0,0,0,0.2)] lg:rounded-[4px]'" />

					<div class="mt-[22px]">
						<h2 class="mb-[22px] flex items-center justify-center flex-nowrap"><span class="h-[1px] w-full bg-[#DADCE0]"></span><span class="px-[25px] text-xs leading-[14px] text-[#999] whitespace-nowrap">Advertisememt</span><span class="h-[1px] w-full bg-[#DADCE0]"></span></h2>
						<div class="flex items-center justify-center ads-wrapper mb-[20px]">
							<x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'cat_idBanner3')" :code-banner="'cat_idBanner3'"/>
						</div>
						<div class="flex items-center justify-center ads-wrapper mb-[20px]">
							<x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'cat_idBanner4')" :code-banner="'cat_idBanner4'"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="w-full px-[15px] lg:py-[40px] mb-[40px] bg-white">
		<div class="container mx-auto">
			<x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'cat_idBannerCenter3')" :code-banner="'cat_idBannerCenter3'"/>
		</div>
	</div>
@endsection
