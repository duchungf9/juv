@extends('website.app')
@section('bodyBg', 'bg-white')
@section('content')

    <div class="mt-[105px] hidden lg:block"></div>
    <x-website.widgets.banners :template="'banner-top'" :id-banner="data_get($site_settings,'cat_idBannerCenter1')" :code-banner="'cat_idBannerCenter1'" :height="250" :width="970"/>

    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb flex items-end">
            <div class="page-breadcrumb__item">{{ $ico->name }}</div>
        </div>
    </x-website.ui.breadcrumbs>


    <div class="w-full">
        <div class="container px-[35px] w-full lg:px-0 my-[15px] flex flex-wrap mx-auto justify-center gap-[40px] relative">
            <div class="lg:w-[770px] md:w-[760px] w-full p-[40px] boxShadow shadow-[#0000001a] mt-[40px]">
                <div class="flex flex-wrap">
                    <div class="w-full md:w-[60px] md:mr-[20px] mr-0 mx-auto">
                        <img class="object-cover rounded-[999px] mx-auto md:w-[60px] w-[100px] md:h-[60px] h-[100px]" src="{{ImgHelper::get_cached($ico->ico_image)}}" alt="">
                    </div>
                    <div class="md:w-[calc(100%_-_80px)] w-full mt-[20px] md:mt-0">
                        <h2 class="leading-[36px]"><span class="text-[36px]">{{$ico->name}}</span> <span class="text-[22px] text-[#0000008c]">{{$ico->type}}</span></h2>
                        <p class="">{!! $ico->long_description !!}</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-[40px] mt-[40px]">
                    <div class="w-full lg:w-[calc(100%_-_245px)] h-[366px]">
                        <img class="object-cover w-full h-[100%]" src="{{ImgHelper::get_cached($ico->img_container)}}" alt="">
                    </div>
                    <div class="w-full lg:w-[205px] h-[366px] px-[15px] pt-[25px] pb-[4px] border-[1px] border-[#ededed] text-center">
                        <div class="mb-[15px]">{{  $ico->status == "active" ? "Kết thúc" : "Bắt đầu"  }}</div>
                        <div class="sale-date upcoming"><strong>Lúc {{ $ico->token_sale }}</strong></div>
                        <div class="leading-[20px] my-[30px]">
{{--                            <div class="text-[#2f80ed] text-[22px] font-bold">$6,290,000 </div>--}}
                            <div class="text-[#0000008c] font-semibold">GOAL <br/>{{$ico->goal}}</div>
                        </div>
                        <a href="https://pax.world/?utm_source=icodrops" target="_blank" rel="nofollow"><div class="max-w-[173px] mx-auto bg-[#2f80ed] rounded-[4px] h-[26px] leading-[26px] text-[#fff]">WEBSITE</div></a>
                        <a href="https://docsend.com/view/sx4eg8yfm455ivje" target="_blank" rel="nofollow"><div class="max-w-[173px] mx-auto mt-[10px] rounded-[4px] bg-[#2f80ed] h-[26px] leading-[26px] text-[#fff]">WHITEPAPER</div></a>
                        <div class="text-[#0000008c] mb-[5px] mt-[15px]">social links</div>
                        <div>

                            @if(json_decode($ico->social_links) != false)
                                @foreach(json_decode($ico->social_links) as $link)
                                    <a href="{{$link}}" target="_blank" class="mr-[5px]"><i class="fa fa-{{detectSocialNameByUrl($link)}}" aria-hidden="true"></i></a>
                                @endforeach
{{--                            <a href="https://t.me/PAXworldOFFICIAL" target="_blank" class="mr-[5px]"><i class="fa fa-telegram" aria-hidden="true"></i></a>--}}
{{--                            <a href="https://www.linkedin.com/company/pax-world/" target="_blank" class="mr-[5px]"><i class="fa fa-linkedin" aria-hidden="true"></i></a>--}}
{{--                            <a href="https://medium.com/@PAXworldOFFICIAL" target="_blank" class="mr-[5px]"><i class="fa fa-medium" aria-hidden="true"></i></a>--}}
{{--                            <a href="https://discord.com/invite/paxworldofficial" target="_blank" class="mr-[5px]"><i class="fa fa-slack" aria-hidden="true"></i></a>--}}
{{--                            <a href="https://www.youtube.com/channel/UCbZHKgOPm9JCsOQtFHFIK4w" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>--}}
{{--                                    ["https:\/\/twitter.com\/PandoraProtocol","https:\/\/t.me\/PandoraProtocol","https:\/\/www.linkedin.com\/company\/pandoraprotocol\/","https:\/\/medium.com\/pandoraprotocol"]--}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="w-full border-t-[1px] border-[#ededed] mt-[40px] p-[40px]">
                    <div class="flex justify-between flex-wrap">
                        <div class="w-full mb-[20px]">
                            <i class="fa fa-calendar text-[#2f80ed]" aria-hidden="true"></i>
                            <h4 class="inline text-[20px] font-bold uppercase">
                                {{  $ico->status == "active" ? "Kết thúc" : "Bắt đầu"  }} Lúc {{ $ico->token_sale }}
                            </h4>
                        </div>
                        <ul class="lg:w-[50%] text-[#000] mr-[20px] text-[18px] font-semibold">
                            <li class="py-[6px]"><span class="text-[#0000008c] font-normal">Ticker: </span>{{$ico->ticker}}</li>
                            <li class="py-[6px]"><span class="text-[#0000008c] font-normal">Token type: </span>{{$ico->token_type}}</li>
                            <li class="py-[6px]"><span class="text-[#0000008c] font-normal">ICO Token Price:</span> {{$ico->token_price}} </li>
                            <li class="py-[6px]"><span class="text-[#0000008c] font-normal">Fundraising Goal:</span>{{$ico->fundraising_goal}} Token </li>
                            <li class="py-[6px]"><span class="text-[#0000008c] font-normal">Total Tokens: </span>{{$ico->total_token}}</li>
                        </ul>
                        <ul class="lg:w-[calc(50%_-_20px)]">
                            <li><span class="grey">Whitelist: </span>
                                @if($ico->white_list != null)
                                Yes (period isn't set,
                                <a class="list__link text-[#2f80ed]" href="{{$ico->white_list}}" target="_blank" rel="nofollow">JOIN</a>
                                <i class="fa fa-external-link" aria-hidden="true"></i>)
                                @else
                                NO
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full border-t-[1px] border-[#ededed] p-[40px]">
                    <div class="w-full">
                        <i class="fa fa-bullseye text-[#2f80ed]" aria-hidden="true"></i>
                        <h4 class="inline text-[20px] font-bold uppercase">Short Review</h4>
                    </div>
                    <ul class="w-full mt-[20px]">
                        <li><span class="grey">Role of Token: </span>{{$ico->role_of_token}}</li>
                    </ul>
                </div>
{{--                <div class="w-full border-t-[1px] border-[#ededed] p-[40px]">--}}
{{--                    <div class="w-full">--}}
{{--                        <i class="fa fa-link text-[#2f80ed]" aria-hidden="true"></i>--}}
{{--                        <h4 class="inline text-[20px] font-bold uppercase">Additional links</h4>--}}
{{--                    </div>--}}
{{--                    <ul class="w-full mt-[20px]">--}}
{{--                        <li>- <a href="https://docsend.com/view/khcbf6iemsdyt2u2" class="text-[#2f80ed]" target="_blank" rel="nofollow">--}}
{{--                                Tokenomics</a>--}}
{{--                            <i class="fa fa-external-link text-[#2f80ed]" aria-hidden="true"></i>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
            <div class="w-full max-w-[770px] lg:px-0 lg:w-[calc(100%_-_850px)] mt-[40px] lg:mr-[40px] mr-0">
                @if($other_ico != null)
                    @foreach($other_ico as $o_ico)
                        <div class="boxShadow p-[20px] mb-[20px]">
                    <a href="{{$o_ico->getPermalink()}}" class="block">
                        <div class="white-desk ico-card ">
                            <div class="flex">
                                <div class="w-[60px] h-[60px] mr-[20px]">
                                    <a href="{{$o_ico->getPermalink()}}" class="block" rel="bookmark">
                                        <img class="object-cover rounded-[999px] h-[100%]" src="{{ImgHelper::get_cached($o_ico->ico_image,config('fromSky.image.thumbnail_small'))}}" alt="">
                                    </a>
                                </div>
                                <div class="text-[#000] w-[calc(100%_-_80px)]">
                                    <h3 class="text-[18px] font-bold"><a class="text-[#000]" href="{{$o_ico->getPermalink()}}" rel="bookmark">{{$o_ico->name}}</a></h3>
                                    <div class="my-[5px]">{{$o_ico->type}}</div>
                                    <div class="text-[#0000008c]">
                                        GOAL: {{$o_ico->goal}}
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between text-[#0000008c] mt-[15px]">
                                <div class="nr">{{$o_ico->token_type}}</div>
                                <div>DATE: {{ $o_ico->token_sale }} </div>
                            </div>
                        </div>
                    </a>
                </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
