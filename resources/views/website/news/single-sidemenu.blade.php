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

    {{--    <x-website.ui.side-menu content="{!!  $news->description !!}"/>--}}


    <div class="container px-[35px] lg:px-0 lg:my-[40px] my-[15px] flex flex-wrap mx-auto items-start">

        <div class="lg:w-[200px] hidden lg:block w-full shadow-[0_0_6px_rgba(0,0,0,0.2)] border-t-[2px] border-solid border-[#000] rounded-b-[4px] pb-[22px]">
            <h3 class="text-lg leading-[28px] font-bold px-[20px] py-[17px]">{{__('website.post_index_lbl')}}</h3>
            <ul class="table-content">
                @foreach($menu->where("parent_id",null) as $item)
                    <li class="mb-[2px]">
                        <a href="javascript:void(0);" onclick="findElementByHeading(`h{{$item->level}}`,`{!!   strip_tags($item->title) !!}`)" class="block pl-[14px] py-[10px] bg-[#F1F3F4] text-md leading-[23px] font-bold relative"><i class="absolute left-0 top-0 w-[4px] h-full bg-[#606368]"></i> {!!  strip_tags($item->title) !!}</a>
                        <ul></ul>
                        @foreach($menu->where("parent_id",$item->id)->where("parent_id","!=",null) as $submenu => $submenu_value)
                            <li class="py-[5px] px-[15px] border-solid border-[#DADCE0] border-b-[1px]"><a href="javascript:void(0);" onclick="findElementByHeading(`h{{$submenu_value->level}}`,`{!!   strip_tags($submenu_value ->title) !!}`)" class="text-md leading-[28px] text-[#202124] flex"><span class="w-[3px] h-[3px] mt-[13px] mr-[10px] bg-[#202124] rounded-[50%]"></span><span class="flex-[1]">{!! strip_tags($submenu_value->title) !!}</span></a></li>
                        @endforeach
                    </li>
                @endforeach
{{--                <li class="mb-[2px]"><a href="javascript:;" class="block pl-[14px] py-[10px] bg-[#F1F3F4] text-md leading-[23px] font-bold relative"><i class="absolute left-0 top-0 w-[4px] h-full bg-[#606368]"></i>Hướng dẫn mua bán Fetch.Ai(FET)</a></li>--}}
{{--                <li class="mb-[2px] active">--}}
{{--                    <a href="javascript:;" class="block pl-[14px] py-[10px] bg-[#F1F3F4] text-md leading-[23px] font-bold relative"><i class="absolute left-0 top-0 w-[4px] h-full bg-[#606368]"></i>Thông tin chi tiết về Fetch.Ai(FET)</a>--}}
{{--                    <ul>--}}
{{--                        <li class="py-[5px] px-[15px] border-solid border-[#DADCE0] border-b-[1px]"><a href="" class="text-md leading-[28px] text-[#202124] flex"><span class="w-[3px] h-[3px] mt-[13px] mr-[10px] bg-[#202124] rounded-[50%]"></span><span class="flex-[1]">Thông tin cơ bản về đồng FET token</span></a></li>--}}
{{--                        <li class="py-[5px] px-[15px] border-solid border-[#DADCE0] border-b-[1px]"><a href="" class="text-md leading-[28px] text-[#202124] flex"><span class="w-[3px] h-[3px] mt-[13px] mr-[10px] bg-[#202124] rounded-[50%]"></span><span class="flex-[1]">Thông tin cơ bản về đồng FET token</span></a></li>--}}
{{--                        <li class="py-[5px] px-[15px] border-solid border-[#DADCE0] border-b-[1px]"><a href="" class="text-md leading-[28px] text-[#202124] flex"><span class="w-[3px] h-[3px] mt-[13px] mr-[10px] bg-[#202124] rounded-[50%]"></span><span class="flex-[1]">Thông tin cơ bản về đồng FET token</span></a></li>--}}
{{--                        <li class="py-[5px] px-[15px] border-solid border-[#DADCE0] border-b-[1px]"><a href="" class="text-md leading-[28px] text-[#202124] flex"><span class="w-[3px] h-[3px] mt-[13px] mr-[10px] bg-[#202124] rounded-[50%]"></span><span class="flex-[1]">Thông tin cơ bản về đồng FET token</span></a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="mb-[2px]"><a href="javascript:;" class="block pl-[14px] py-[10px] bg-[#F1F3F4] text-md leading-[23px] font-bold relative"><i class="absolute left-0 top-0 w-[4px] h-full bg-[#606368]"></i>2021 Roadmap</a></li>--}}
            </ul>
        </div>




        <div class="lg:w-[790px] w-full lg:ml-[90px] lg:mr-[60px]">
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

        </div>
        <div class="ads w-full lg:w-auto">
            <div class="lg:block hidden">
                <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'detail2_idBanner1')" :code-banner="'detail2_idBanner1'"/>
            </div>
            <div class="block w-full lg:hidden mt-[20px] mx-auto">
                <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'detail2_idBanner2')" :code-banner="'detail2_idBanner2'"/>
            </div>
        </div>
    </div>
    <div class="container mx-auto flex flex-wrap mt-[40px] px-[35px] lg:px-0">
        <div class="lg:w-[880px] w-full lg:mr-[90px] border-t-[2px] border-[#202124]">
            <h2 class="pl-[20px]"><span class="inline-block mt-[-2px] py-[12px] text-lg leading-[28px] font-bold border-t-[4px] border-[#D72E22] tracking-[-0.04em]">TIN CÙNG CHUYÊN MỤC</span></h2>
            @foreach ($news as $k=>$post)
                <x-website.news.item :post="$post"></x-website.news.item>
            @endforeach

        </div>
        <div class="lg:w-[330px] w-full">
            <div class="border-t-[2px] border-[#202124] bg-[#F1F3F4] rounded-b-[4px]">
                <x-website.news.good-news :category="$category"></x-website.news.good-news>
            </div>
            <div class="my-[20px]">
                <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'detail2_idBanner3')" :code-banner="'detail2_idBanner3'"/>
            </div>
        </div>
    </div>



    <div class="w-full px-[15px] lg:py-[40px] mb-[40px] bg-white">
        <div class="container mx-auto">
            <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'detail_idBannerCenter3')" :code-banner="'detail_idBannerCenter3'"/>
        </div>
    </div>



@endsection
@section("footerjs")
    <script>
        let model_data = { model : "{!! class_basename($post) !!}", id:"{{$post->id}}"};
    </script>
    <script src="/website/js/visitor/logvisitor.js"></script>
    <script>
        let testVar = null;
        function findElementByHeading(heading, content){
            let allHeadingof = document.querySelectorAll(heading);
            let matchingElement= null;
            Object.keys(allHeadingof).map(key=>{
                let selfHeading = allHeadingof[key];
                if(selfHeading.textContent.includes(content)){
                    matchingElement = selfHeading;
                }
            });

            if(matchingElement != null){
                const yOffset = -150;
                const y = matchingElement.getBoundingClientRect().top + window.pageYOffset + yOffset;
                setTimeout(()=>{
                    // matchingElement.scrollIntoView(true);
                    window.scrollTo({top: y, behavior: 'smooth'});

                },200)
            }
        }
    </script>
@endsection
