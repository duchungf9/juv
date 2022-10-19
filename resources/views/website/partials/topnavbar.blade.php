<div class="w-full h-[56px] mx-auto pt-2 pb-2 border-b-[1px] border-[#DADCE0] border-solid relative">
    <div class="container mx-auto h-[100%] px-[15px] lg:px-[0px]">
        <div class="flex h-[100%] justify-between items-center">
            <button type="button" class="dropdown-toggle w-[25px] h-[24px] bg-[url('../images/icon-menu.svg')] lg:hidden"></button>
            <time class="text-[#606368] text-xs leading-[14px] tracking-[-0.005em] hidden lg:block">{{now()->toDayDateTimeString()}}</time>
            <a href="/" title="Logo" class="absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"><img class="block w-[169px] h-[35px] block z-20 transition-all object-cover lg:w-[235px] lg:h-[48px]"
                                          src="/images/logo.png"
                                          alt="{{config('fromSky.website.option.app.name')}}" /></a>
            <div class="login hidden">
                <div class="items-center hidden login__before lg:flex">
                    @if(auth()->check() == false)
                    <a href="/social_auth/google" title="" class="text-xam text-sm font-bold mr-[20px]">Đăng nhập</a>
{{--                    <a href="" title="" class="btn-register flex items-center justify-center w-[152px] h-[36px] bg-[#D72E22] rounded-[4px] text-white"><i class="icon w-[24px] h-[24px] bg-[url('../images/icon-user.svg')] mr-[6px]"></i> Đăng ký ngay</a>--}}
                    @else
                    <a href="javascript:void(0)" title="" class="text-xam text-sm font-bold mr-[20px]">{{ auth()->user()?->full_name }}</a>
                    <a href="{{route("logout")}}" title="" class="btn-register flex items-center justify-center w-[152px] h-[36px] bg-[#D72E22] rounded-[4px] text-white"><i class="icon w-[24px] h-[24px] bg-[url('../images/icon-user.svg')] mr-[6px]"></i> Logout</a>

                    @endif
                </div>
                <button type="button" class="lg:hidden w-[24px] h-[24px] bg-[url('../images/avt.svg')]"></button>
            </div>
        </div>
    </div>
</div>