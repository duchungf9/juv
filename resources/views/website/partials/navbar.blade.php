@php
    $page = $page??null;
    $locale_page = $locale_page??$page;
@endphp

{{-- <nav class="sticky z-50 flex flex-wrap items-center content-between">
    <div class="container items-center mx-auto bg-gray-400">
        <ul class="flex p-0 m-0 mx-auto list-none ">
            {!! HtmlMenu::getBeforeNavbar() !!}
            {!! HtmlMenu::getPageLinks($page) !!}
            {!! HtmlMenu::getAfterNavbar() !!}            
            {!! HtmlMenu::getAuthLinks() !!}
            {!! HtmlMenu::getLanguageSelector($locale_page) !!}
            <li class="relative flex group" data-slug="chart" id="searchboxContainer">

            </li>            
        </ul>
    </div>
</nav>  --}}
@if(request()->route()->getName() === 'home' || mobileDt()->isDesktop())
    <nav class="w-full mx-auto flex flex-wrap items-center content-between sticky z-50 border-b-[1px] border-[#DADCE0] border-solid">
        <div class="container flex mx-auto items-center px-[15px] lg:px-[0px] overflow-x-scroll lg:overflow-x-visible">
            <div class="w-full">
                <ul class="nav-menu list-none p-0 lg:ml-[-20px] flex mx-auto">
                    {!! HtmlMenu::getPageLinks($page) !!}
                </ul>
            </div>
            <div action="" method="" class="relative hidden ml-auto lg:block"  id="searchboxContainer">
{{--                <input class="w-[310px] h-[36px] bg-[#F1F3F4] px-[20px] rounded-[9999px]" type="text" name="" placeholder="Nhập từ khóa tìm kiếm ...">--}}
{{--                <button type="submit" class="w-[24px] h-[24px] bg-[url('../images/icon-search.svg')] absolute top-[6px] right-[20px]"></button>--}}
            </div>
        </div>
    </nav>
@endif
<!----------------------NAV DROP---------------------->
<div class="dropdown-mobile fixed bg-white w-full h-full top-[56px] left-[-100%] z-50 transition-all lg:hidden">
    <form action="" class="bg-[#F1F3F4] px-[35px] py-[10px] relative">
        <div class="relative">
            <input class="w-full h-[48px] rounded-[4px] bg-white border-[1px] border-[##DADCE0] border-solid px-[20px]" type="text" placeholder="Nhập từ khóa tìm kiếm ...">
            <button type="submit" class="w-[24px] h-[24px] bg-[url('../images/icon-search.svg')] absolute top-[12px] right-[12px]"></button>
        </div>
    </form>
    <div class="px-[35px]">
        <ul class="menu-2 mt-[20px] border-solid border-t-[1px] border-[#DADCE0]">
            {!! HtmlMenu::getPageLinks($page,'-mobile') !!}
        </ul>
    </div>
</div>
<!----------------------//NAV DROP---------------------->




