@extends('website.app')
@section('bodyBg', 'bg-white')
@section('content')
    <div class="lg:mt-[105px] mt-[50px] lg:block"></div>
    <x-website.widgets.banners :template="'banner-top'" :id-banner="data_get($site_settings,'detail_idBannerCenter1')" :code-banner="'detail_idBannerCenter1'" :height="250" :width="970"/>

    <div class="container px-[35px] lg:px-0 mx-auto flex flex-wrap items-center py-[16px] border-b-[1px] border-solid border-[#F1F3F4]">
        <ul class="bre flex items-center">
            <li><a href="" title="" class="text-xs leading-[14px] text-[#606368]">{{__('website.home')}}</a></li>
            @foreach($categoryParent as $cat)
                @if(!empty($cat))
                <li><img class="mx-[10px]" src="/images/arr-r.svg" width="18" alt="{{$cat->title}}"></li>
                <li><a href="{{$cat->getPermalink()}}" title="{{$cat->title}}" class="text-xs leading-[14px] text-[#606368]">{{$cat->title}}</a></li>
                @endif
            @endforeach
        </ul>
        <time class="md:ml-auto mt-[10px] md:mt-0 text-xs leading-[14px] text-[#606368]">{{Carbon::parse($post->date)->toDateTimeLocalString()}}</time>
    </div>
    <div class="container px-[35px] lg:px-0 lg:my-[40px] my-[15px] flex flex-wrap mx-auto items-start relative">
        <div class="lg:w-3/4 w-full lg:pr-[75px]">
            <div class="flex">
                <div class="sticky mr-[54px] top-[125px] hidden lg:block">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{$post->getPermalink()}}" class="w-[36px] h-[36px] flex items-center justify-center my-[6px] rounded-[50%] border-[1px] border-[#BDBDBD]"><img src="/images/icon-fb.svg" alt=""></a>
                    <a href="https://twitter.com/intent/tweet?text={{htmlspecialchars(urlencode(html_entity_decode($post->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')}}&url={{$post->getPermalink()}}" class="w-[36px] h-[36px] flex items-center justify-center my-[6px] rounded-[50%] border-[1px] border-[#BDBDBD]"><img src="/images/icon-tw.svg" alt=""></a>
                    <span class="w-[36px] h-[1px] block bg-[#ECECEC] my-[12px]"></span>
                    <a href="https://telegram.me/share/url?url={{$post->getPermalink()}}&text={{htmlspecialchars(urlencode(html_entity_decode($post->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')}}" class="w-[36px] h-[36px] flex items-center justify-center my-[6px] rounded-[50%] border-[1px] border-[#BDBDBD]"><img src="/images/icon-cc.svg" alt=""></a>
                    <a href="" class="w-[36px] h-[36px] flex items-center justify-center my-[6px] rounded-[50%] border-[1px] border-[#BDBDBD]"><img src="/images/icon-qs.svg" alt=""></a>
                    <span class="w-[36px] h-[1px] block bg-[#ECECEC] my-[12px]"></span>
                    <a href="{{$category->getPermalink()}}" title="Quay lại {{$category->title}}" class="w-[36px] h-[36px] flex items-center justify-center my-[6px] rounded-[50%] border-[1px] border-[#BDBDBD]"><img src="/images/arr-l.svg" width="18" alt="{{$category->title}}"></a>
                </div>
                <div>
                    <h1 class="mb-[10px] lg:text-[46px] text-[24px] lg:leading-[56px] leading-[33px] text-[#202124] font-bold">{{$post->title}}</h1>
                    <article class="lg:text-lg text-md leading-[28px] lg:leading-[32px]">
                        <div class="resetDefault">
                            {!! $post->description !!}
                        </div>

                        @foreach($post->tags as $tag)
                            <a class="px-[6px] py-[4px] mr-[10px] text-xs text-white inline-block rounded-[2px] bg-[#3474E0]" href="{{$tag->getPermalink()}}">{{$tag->title}}</a>
                        @endforeach
                    </article>
                </div>
            </div>
            <div class="flex flex-wrap items-center bg-[#F5F5F5] rounded-[4px] py-[11px] px-[20px]">
                <a href="{{$category->getPermalink()}}" class="flex rounded-[4px] justify-center w-[189px] h-[36px] items-center bg-[#fff] border-solid border-[1px] border-[#BDBDBD] text-sm leading-[22px] text-[#606368]"><i class="block w-[16px] h-[9px] bg-[url('../images/arr-l.svg')] mr-[6px]"></i> Trở lại {{strtolower($category->title)}}</a>
                <div class="flex items-center ml-auto py-[10px] lg:py-0">
                    <h5 class="text-md leading-[22px] text-[#222] mr-[15px]">Chia sẻ bài viết: </h5>
                    <div class="flex items-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{$post->getPermalink()}}" class="w-[36px] h-[36px] bg-[#fff] border-solid border-[1px] border-[#BDBDBD] rounded-[50%] flex items-center justify-center ml-[12px]"><img src="/images/icon-fb.svg" alt=""></a>
                        <a href="https://twitter.com/intent/tweet?text={{htmlspecialchars(urlencode(html_entity_decode($post->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8')}}&url={{$post->getPermalink()}}" class="w-[36px] h-[36px] bg-[#fff] border-solid border-[1px] border-[#BDBDBD] rounded-[50%] flex items-center justify-center ml-[12px]"><img src="/images/icon-tw.svg" alt=""></a>
                        <a href="mailto:dia_chi_mail@gmail.com?subject=Tin bài hay &body={{$post->title}} -- {{$post->getPermalink()}}" class="w-[36px] h-[36px] bg-[#fff] border-solid border-[1px] border-[#BDBDBD] rounded-[50%] flex items-center justify-center ml-[12px]"><img src="/images/icon-mail.svg" alt=""></a>
                        <span id="myInput" onclick="navigator.clipboard.writeText('https:{{$post->getPermalink()}}');alert('Copy link '+ 'https:{{$post->getPermalink()}}');" title="Click copy link" class="w-[36px] h-[36px] bg-[#fff] border-solid border-[1px] border-[#BDBDBD] rounded-[50%] flex items-center justify-center ml-[12px] cursor-pointer"><img src="/images/icon-link.svg" alt=""></span>
                    </div>
                </div>
            </div>

            <div class="w-full mt-[40px] border-t-[2px] border-[#202124]">
                <h2 class="pl-[20px]"><span class="inline-block mt-[-2px] py-[12px] text-lg leading-[28px] font-bold border-t-[4px] border-[#D72E22] tracking-[-0.04em]">TIN CÙNG CHUYÊN MỤC</span></h2>

                @foreach ($news as $k=>$post)
                    <x-website.news.item :post="$post"></x-website.news.item>
                @endforeach

            </div>
        </div>

        <div class="w-full mt-[20px] lg:mt-0 lg:px-0 lg:w-1/4">

            <x-website.news.good-news :category="$category"></x-website.news.good-news>

            <x-website.carousels.investment-carousel :class-list="'mt-[20px] border-t-[1px] lg:shadow-[0_0_6px_rgba(0,0,0,0.2)] lg:rounded-[4px]'" />

            <div class="mt-[22px]">
                <h2 class="mb-[22px] flex items-center justify-center flex-nowrap"><span class="h-[1px] w-full bg-[#DADCE0]"></span><span class="px-[25px] text-xs leading-[14px] text-[#999] whitespace-nowrap">Advertisememt</span><span class="h-[1px] w-full bg-[#DADCE0]"></span></h2>
                <div class="flex items-center justify-center ads-wrapper mb-[20px]">
                    <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'detail_idBanner3')" :code-banner="'detail_idBanner3'"/>
                </div>
                <div class="flex items-center justify-center ads-wrapper mb-[20px]">
                    <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'detail_idBanner4')" :code-banner="'detail_idBanner4'"/>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full px-[15px] lg:py-[40px] mb-[40px] bg-white">
        <div class="container mx-auto">
            <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'detail_idBannerCenter3')" :code-banner="'detail_idBannerCenter3'"/>
        </div>
    </div>

    {{--<section class="py-2 md:py-6">
        <div class=""></div>
		<div class="container mx-auto sm:px-4">
            <div class="flex flex-wrap ">
                <div class="w-full pl-4 pr-4 md:w-3/4">
                    <x-website.news.single :news="$post"/>

                </div>
                <div class="hidden w-full pl-4 pr-4 md:w-1/4 md:block">
                    <x-website.news.sidebar/>
                    <x-website.news.tags/>
                </div>
            </div>
		</div>
 	</section>--}}



@endsection
@section("footerjs")
    <script>
        let model_data = { model : "{!! class_basename($post) !!}", id:"{{$post->id}}"};
    </script>
    <script src="/website/js/visitor/logvisitor.js"></script>
    <script>
        let testVar = null;
        function findElementByHeading(heading, content){
            let xpath = "//"+heading+"[contains(text(),'"+content+"')]";
            let matchingElement  =  document.evaluate(xpath, document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
            if(matchingElement){
                testVar = matchingElement;
                testVar.scrollIntoView(true);
                console.log(matchingElement);
                setTimeout(()=>{
                    matchingElement.scrollIntoView(true);
                },200)
            }
        }
    </script>
@endsection
