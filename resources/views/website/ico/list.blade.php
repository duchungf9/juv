@extends('website.app')
@section('bodyBg', 'bg-white')
@section('content')

    <div class="mt-[105px] hidden lg:block"></div>
    <x-website.widgets.banners :template="'banner-top'" :id-banner="data_get($site_settings,'cat_idBannerCenter1')" :code-banner="'cat_idBannerCenter1'" :height="250" :width="970"/>

    <x-website.ui.breadcrumbs class="bg-accent">
        <div class="text-white page-breadcrumb flex items-end">
            <div class="page-breadcrumb__item">ICO Calendar</div>
        </div>
    </x-website.ui.breadcrumbs>


    <div class="w-full">
        <div class="container w-full mx-auto">
            <div class="header mb-[20px] pt-[20px] border-b-[1px] hidden lg:block">
                <h2 class="mb-[16px] text-[32px] leading-[37px] text-[#202124] font-bold">ICO Calendar</h2>
            </div>
            <div class="flex items-center py-[16px] px-[20px] lg:hidden overflow-auto">
                <a href="" title=""><i class="w-[24px] h-[24px] block bg-[url('../images/icon-home.svg')]"></i></a>
                <span class="w-[1px] h-[24px] bg-[#DADCE0] mx-[20px]"></span>
                <a href="" title="" class="text-sm leading-[18px] font-bold text-red whitespace-nowrap">TIN TỨC</a>
                <a href="" title="" class="text-sm leading-[18px] font-bold text-[#3D4043] pl-[20px] whitespace-nowrap">Tin thị trường</a>
                <a href="" title="" class="text-sm leading-[18px] font-bold text-[#3D4043] pl-[20px] whitespace-nowrap">Kiến thức cơ bản</a>
            </div>
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:px-[15px] lg:px-0 border-b-[1px] border-[#DADCE0] justify-center flex flex-wrap pb-[40px]">
                    <div class="w-full lg:w-[33%] sm:w-[50%] justify-center px-[15px]">
                        <h2 class="text-[24px] font-bold text-[#383838] uppercase my-[20px] pl-[20px]">Active Ico</h2>
                        <div class="boxShadow">
                            @foreach($list->where("status","active") as $ico)
                                <div class="border-t-[1px] border-[#e2e2e4] first:border-0 flex p-[20px]">
                                    <div class="w-[60px] mr-[10px]">
                                        <a href="{{$ico->getPermalink()}}" class="">
                                            <img  src="{{ImgHelper::get_cached($ico->ico_image,config('fromSky.image.thumbnail'))}}" class="w-[60px] h-[60px] rounded-full" alt="" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="w-[calc(100%_-_70px)]">
                                        <h3 class="font-bold">{{$ico->name}}</h3>
                                        <div class="my-[5px]">{{$ico->type}}</div>
                                        <div class="text-[#0000008c]">{{$ico->token_sale}}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full lg:w-[33%] sm:w-[50%] justify-center px-[15px]">
                        <h2 class="text-[24px] font-bold text-[#383838] uppercase my-[20px] pl-[20px]">Upcomming Ico</h2>
                        <div class="boxShadow">
                            @foreach($list->where("status","upcomming") as $ico)
                                <div class="border-t-[1px] border-[#e2e2e4] first:border-0 flex p-[20px]">
                                    <div class="w-[60px] mr-[10px]">
                                        <img  src="{{ImgHelper::get_cached($ico->ico_image,config('fromSky.image.thumbnail'))}}" class="w-[60px] h-[60px] rounded-full" alt="" loading="lazy">
                                    </div>
                                    <div class="w-[calc(100%_-_70px)]">
                                        <h3 class="font-bold">{{$ico->name}}</h3>
                                        <div class="my-[5px]">{{$ico->type}}</div>
                                        <div class="text-[#0000008c]">{{$ico->token_sale}}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-full px-[35px] mt-[20px] lg:mt-0 lg:px-0 lg:w-1/4 lg:pl-[20px]">
            </div>
        </div>
    </div>

    <div class="w-full px-[15px] lg:py-[40px] mb-[40px] bg-white">
        <div class="container mx-auto">
            <x-website.widgets.banners :template="'banner'" :id-banner="data_get($site_settings,'cat_idBannerCenter3')" :code-banner="'cat_idBannerCenter3'"/>
        </div>
    </div>
@endsection
