@extends('website.app')
@section('bodyBg', 'bg-white')
@section('content')

    <div class="mt-[105px] hidden lg:block"></div>
    <x-website.widgets.banners :template="'banner-top'" :id-banner="data_get($site_settings,'cat_idBannerCenter1')" :code-banner="'cat_idBannerCenter1'" :height="250" :width="970"/>


    <div class="w-full mt-[56px]">
        <div class="container w-full mx-auto">
            <div class="header mb-[20px] pt-[20px] border-b-[1px] hidden lg:block">
                <h1 class="mb-[16px] text-[32px] leading-[37px] text-[#202124] font-bold">{{$category->title}}</h1>
                @if($category->children->count()>0)
                    <ul class="flex">
                        @if(count($categoryChildren)>0)
                            @foreach($categoryChildren as $catChild)
                                @if($catChild->slug===$category->slug)
                                    <li>
                                        <a href="{{$catChild->getPermalink()}}" title="{{$catChild->title}}" class="block text-md leading-[23px] font-bold text-[#606368] mr-[40px] pb-[20px] border-b-4 border-b-black">{{$catChild->title}}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{$catChild->getPermalink()}}" title="{{$catChild->title}}" class="block text-md leading-[23px] font-bold text-[#606368] mr-[40px] pb-[20px]">{{$catChild->title}}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                @endif
            </div>
            <div class="flex items-center py-[16px] px-[20px] lg:hidden overflow-auto">
                <a href="/" title=""><i class="w-[24px] h-[24px] block bg-[url('../images/icon-home.svg')]"></i></a>
                <span class="w-[1px] h-[24px] bg-[#DADCE0] mx-[20px]"></span>
                <a href="{{$category->getPermalink()}}" title="{{$category->title}}" class="text-sm leading-[18px] font-bold text-red whitespace-nowrap">{{$category->title}}</a>
            </div>

            <div class="flex flex-wrap justify-between">
                <div class="md:w-full lg:w-3/4 md:px-[15px] lg:px-0 md:grid md:grid-cols-3 border-b-[1px] border-[#DADCE0]">
                    @php $firstNews = $news[0]; @endphp
                    <article class="md:pb-[20px] md:border-b-[1px] border-[#DADCE0] md:col-start-1 md:col-end-4">
                        <div class="flex flex-wrap bg-[#F1F3F4]">
                            <a href="{{$firstNews->getPermalink()}}" class="lg:w-[530px] md:w-1/2"><img data-src="{{ImgHelper::get_cached($firstNews->image,config('fromSky.image.thumbnail_cat_big'))}}" class="w-full object-cover lozad" alt="{{$firstNews->title}}"></a>
                            <div class="lg:w-[440px] md:w-1/2 px-[35px] py-[20px] lg:p-[20px]">
                                <div class="flex items-center mb-[6px]">
                                    @foreach($firstNews->tags as $tag)
                                        <a class="bg-[#3474E0] text-[#fff] rounded-[2px] text-xs leading-[14px] px-[6px] py-[3px] mr-[10px]" title="{{$tag->title}}" href="{{$tag->getPermalink()}}">{{$tag->title}}</a>
                                    @endforeach
                                </div>
                                <h3 class="mb-[6px] lg:mb-[10px]">
                                    <a href="{{$firstNews->getPermalink()}}" title="{{$firstNews->title}}" class="lg:text-[32px] lg:leading-[40px] text-lg leading-[28px] text-[#202124] font-bold">{{$firstNews->title}}</a>
                                </h3>
                                <p class="text-sm leading-[23px] mb-[6px] lg:mb-[10px]">{{ $firstNews->getExcerpt() }}</p>
                                <time class="text-xs leading-[14px] text-[#606368]">{{ Carbon::parse($firstNews->date)->format('d/m/Y') }}</time>
                            </div>
                        </div>
                    </article>
                    @foreach($news as $k=>$post)
                        @if($k===0) @continue @endif
                        <article class="md:px-[0px] px-[35px] md:py-[20px] lg:px-[0px]">
                            <div class="md:py-[0px] py-[20px] md:pr-[20px] md:mr-[20px] border-b-[1px] md:border-b-[0px] md:border-r-[1px] border-solid border-[#DADCE0]">
                                <h3 class="mb-[6px] lg:mb-[10px]">
                                    <a href="{{ $post->getPermalink() }}" class="text-md leading-[23px] font-bold text-[#202124] tracking-[-0.005em]">{{ $post->title }}</a></h3>
                                <p class="text-sm leading-[23px] text-[#202124] mb-[10px]">{{ $post->getExcerpt() }}</p>
                                <time class="text-xs leading-[14px] text-[#999]">{{ Carbon::parse($post->date)->format('d/m/Y') }}</time>
                            </div>
                        </article>
                        @if($k===3)@break @endif
                    @endforeach
                </div>
                <div class="md:w-full lg:w-1/4 pl-[20px] hidden lg:block">
                    <div class="ml-auto">
                        <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'cat_idBanner1')" :code-banner="'cat_idBanner1'"/>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <div class="w-full my-[20px] py-[20px] bg-[#F1F3F4]">
        <div class="container mx-auto lg:w-[970px] lg:h-[250px]">
            <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'cat_idBanner2')" :code-banner="'cat_idBanner2'"/>
        </div>
    </div>


    <div class="w-full container lg:px-[15px] px-[35px] lg:px-0 mx-auto bg-white">
        <div class="flex flex-wrap">
            <div class="w-full md:w-2/3 md:px-0">
                @foreach ($news as $k=>$post)
                    @if($k<4) @continue @endif
                    <x-website.news.item :post="$post"></x-website.news.item>
                @endforeach
                {{$news->links()}}
            </div>


            <div class="w-full md:w-1/3 lg:px-[35px] md:px-0 md:pl-[20px]">

                <x-website.news.good-news :category="$category"></x-website.news.good-news>

                <x-website.carousels.investment-carousel :class-list="'mt-[20px] border-t-[1px] lg:shadow-[0_0_6px_rgba(0,0,0,0.2)] lg:rounded-[4px]'" />

                <div class="mt-[22px]">
                    <h2 class="mb-[22px] flex items-center justify-center flex-nowrap">
                        <span class="h-[1px] w-full bg-[#DADCE0]"></span><span class="px-[25px] text-xs leading-[14px] text-[#999] whitespace-nowrap">Advertisememt</span><span class="h-[1px] w-full bg-[#DADCE0]"></span>
                    </h2>
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


    <div class="w-full px-[15px] lg:py-[40px] mb-[40px] bg-white">
        <div class="container mx-auto">
            <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'cat_idBannerCenter3')" :code-banner="'cat_idBannerCenter3'"/>
        </div>
    </div>

    {{--<x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-black page-breadcrumb flex items-end">
            <h1 class="">{{$category->title}}</h1>
        </div>
    </x-website.ui.breadcrumbs>

    <section class="py-2 md:py-6">
        <div class="container mx-auto sm:px-4">
            <div class="flex flex-wrap ">
                @foreach ($news as $new)
                    <div class="w-full sm:w-1/2 pr-4 pl-4 lg:w-1/3 pr-4 pl-4 xl:w-1/4 pr-4 pl-4">
                        <x-website.news.item :post="$new"></x-website.news.item>
                    </div>
                @endforeach
            </div>
            <div class="mb-5"></div>
            {{$news->links()}}
        </div>
    </section>--}}

@endsection
