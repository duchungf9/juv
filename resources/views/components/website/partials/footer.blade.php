@inject("social","App\Model\Social")
@php
        $locale_page = $locale_page??null;
@endphp
<footer class="mx-auto px-[35px] lg:px-0 @if(!$isHome) bg-[#F1F3F4] @endif">
    <div class="container mx-auto">
        <div class="flex flex-wrap mx-auto justify-between lg:px-0 lg:py-[29px] py-[29px] pb-[20px] border-solid border-b-[1px] border-[#DADCE0] relative">
            <div class="w-[235px] mb-[22px] lg:mb-0"><a href="/"><img src="/images/logo.png" alt=""></a></div>
            <div class="lg:absolute md:static top-[40px] left-[278px] text-[#666] lg:mb-0 mb-[35px]">{!! data_get($site_settings,'footer_text') !!}</div>
            <form action="" method="" class="w-full lg:w-[508px]" id="form-newsletter">
                <div class="relative form-group">
                    <input type="text" name="" id="email_subcribe" placeholder="Nhập Email đăng ký nhận bản tin ..." class="lg:w-[508px] w-full max-w-full lg:h-[42px] h-[48px] bg-white pl-[28px] text-sm leading-[16px] text-[#999] rounded-[9999px]">
                    <button type="submit" class="lg:w-[159px] w-full lg:h-[36px] h-[48px] mt-[10px] lg:mt-0 mx-auto bg-red flex items-center justify-center lg:absolute lg:right-[3px] lg:top-[3px] text-[#fff] font-bold text-sm rounded-[9999px]">
                        Đăng ký ngay <i class="block ml-[3px] w-[19px] h-[8px] bg-[url('../images/icon-ar.svg')]"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="flex flex-wrap w-full mx-aut lg:mx-[-10px] lg:py-[20px] border-t-[1px] border-t-[#fff] border-solid border-b-[1px] border-b-[#DADCE0]">
            <div class="lg:w-1/3 w-full px-[10px] py-[20px] lg:py-0 border-b-[1px] lg:border-b-[0] border-solid border-[#DADCE0] shadow-[0_1px_0px_rgba(255,255,255,1)] lg:shadow-none">
                <h3 class="mb-[15px] text-md leading-[23px] text-[#606368] font-bold">Danh mục</h3>
                <ul class="flex flex-wrap">
                    {!! HtmlMenu::getPageLinks($page,'-footer') !!}
                </ul>
            </div>
            <div class="lg:w-1/3 w-full px-[10px] py-[20px] lg:py-0 border-b-[1px] lg:border-b-[0] border-solid border-[#DADCE0] shadow-[0_1px_0px_rgba(255,255,255,1)] lg:shadow-none">
                <h3 class="mb-[15px] text-md leading-[23px] text-[#606368] font-bold">Thông tin liên hệ</h3>
                <p class="flex items-center py-[6px] text-sm leading-[23px] text-[#606368] tracking-[-0.015em]">
                    <i class="w-[24px] h-[24px] mr-[10px] bg-[url('../images/icon-addss.svg')]"></i> Số 1 Nguyễn Huy
                    Tưởng, Quận Thanh Xuân, TP. Hà Nội </p>
                <p class="flex items-center py-[6px] text-sm leading-[23px] text-[#606368] tracking-[-0.015em]">
                    <i class="w-[24px] h-[24px] mr-[10px] bg-[url('../images/icon-phone.svg')]"></i>
                    <a href="tel:0982.888.888">0982.888.888</a></p>
                <p class="flex items-center py-[6px] text-sm leading-[23px] text-[#606368] tracking-[-0.015em]">
                    <i class="w-[24px] h-[24px] mr-[10px] bg-[url('../images/icon-maill.svg')]"></i>
                    <a href="mailto:info@reviewcoin.vn">info@reviewcoin.vn</a></p>
            </div>
            <div class="lg:w-1/3 w-full px-[10px] py-[20px] lg:py-0 border-b-[1px] lg:border-b-[0] border-solid border-[#DADCE0] shadow-[0_1px_0px_rgba(255,255,255,1)] lg:shadow-none">
                <h3 class="mb-[20px] text-md leading-[23px] text-[#606368] font-bold">Theo dõi chúng tôi</h3>
                <ul class="flex mx-[-10px]">
                    @foreach($social::renderAllSocialFooter() as $social_object)
                        <li class="px-[10px]">
                            <a href="{{$social_object->link}}" title="{{$social_object->title}}" class="flex items-center justify-center w-[36px] h-[36px] rounded-[50%] bg-[#606368]"><img src="{{$social_object->icon}}" alt=""></a>
                        </li>
                    @endforeach
{{--                    <li class="px-[10px]">--}}
{{--                        <a href="" title="" class="flex items-center justify-center w-[36px] h-[36px] rounded-[50%] bg-[#606368]"><img src="images/icon-facebook.svg" alt=""></a>--}}
{{--                    </li>--}}
{{--                    <li class="px-[10px]">--}}
{{--                        <a href="" title="" class="flex items-center justify-center w-[36px] h-[36px] rounded-[50%] bg-[#606368]"><img src="images/icon-lotus.svg" alt=""></a>--}}
{{--                    </li>--}}
{{--                    <li class="px-[10px]">--}}
{{--                        <a href="" title="" class="flex items-center justify-center w-[36px] h-[36px] rounded-[50%] bg-[#606368]"><img src="images/icon-instagram.svg" alt=""></a>--}}
{{--                    </li>--}}
{{--                    <li class="px-[10px]">--}}
{{--                        <a href="" title="" class="flex items-center justify-center w-[36px] h-[36px] rounded-[50%] bg-[#606368]"><img src="images/icon-twitter.svg" alt=""></a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
        <div class="py-[20px] lg:border-t-[1px] border-solid border-[#fff]">
            <p class="text-center text-sm leading-[23px] text-[#666]">Copyright © 2011 Công ty ReviewCoin <br>
                Số Giấy CN ĐKDN mã số 0101871229 do Sở Kế hoạch và Đầu tư cấp ngày 23/3/2011
                <br/>
                Ngôn ngữ: <?php $array_lang = ['vi'=>"Tiếng Việt",'en'=> "English"]; ?>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a href="{{LaravelLocalization::getLocalizedURL($localeCode, $locale_page->getPermalink($localeCode))}}">{{$array_lang[$localeCode]}}</a>
                @endforeach
            </p>
        </div>
    </div>
</footer>


{{-- <footer class="footer">
    <section class="py-3 footer-widgets bg-color-4">
        <div class="container mx-auto sm:px-4 ">
            <div class="flex flex-wrap items-center ">
                <div class="w-full pl-4 pr-4 md:w-1/2 footer-newsletter">
                    <x-website.widgets.newsletter/>
                </div>
                <div class="w-full pl-4 pr-4 md:w-1/2">
                    <x-website.widgets.social/>
                </div>
            </div>
        </div>
    </section>
    <section class="py-2 bg-blue-600 footer-info">
        <div class="container mx-auto sm:px-4 ">
            <div class="flex flex-wrap items-end">
                <div class="w-full pl-4 pr-4 d-grip md:w-2/3 footer-address">
                    <h4 class="text-center text-md-start">{{ config('fromSky.website.option.app.name') }} </h4>

                    <div class="footer-address-content">
                        &copy; <?php echo date('Y'); ?> {{ config('fromSky.website.option.app.legal') }} - Ver. {{ App::VERSION() }} <br>
                        {{ config('fromSky.website.option.app.address') }} - {{ config('fromSky.website.option.app.locality') }} - P.IVA {{ config('fromSky.website.option.app.vat') }}<br>
                        Tel: {{ config('fromSky.website.option.app.phone') }} - Fax: {{ config('fromSky.website.option.app.fax') }} - <a href="mailto:{{ config('fromSky.website.option.app.email') }}">{{ config('fromSky.website.option.app.email') }}</a>
                    </div>
                </div>

                <div class="w-full pl-4 pr-4 md:w-1/3 footer-legal">
                    <div class="text-center text-md-end">
                        <a href="{{page_permalink_by_id(3)}}"  target="_blank" title="{{ trans('website.privacy')}}">
                            {{ trans('website.privacy')}}
                        </a> |
                        <a href="{{page_permalink_by_id(20)}}" target="_blank" title="{{ trans('website.cookie')}}">
                            {{ trans('website.cookie')}}
                        </a> |
                        <a href="{{ data_get($site_settings,'credits_url') }}" target="_blank">Credits</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer> --}}
