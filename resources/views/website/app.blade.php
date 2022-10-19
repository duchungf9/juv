@inject('pages','App\Model\Page')
<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="{{config('fromSky.website.option.app.name')}}" />
    <meta name="google-site-verification" content="{{data_get($site_settings,'GA_SITE_VERIFICATION')}}" />
    <meta name="theme-color" content="{{data_get($site_settings,'THEME_COLOR')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="R6Ixjco51MJLXAjUMLk0Zl6YQ6Ql_A5b06DTq7Lb4EU" />

    {{-- Meta SEO --}}
    {!! SEO::generate() !!}


    <link href="{{ asset(config('fromSky.admin.path.assets').'images/fav.png') }}" type="image/png" rel="icon">
    <link rel="shortcut icon" type="image/png" href="{{ asset(config('fromSky.admin.path.assets').'images/fav.png') }}"/>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    {{-- <link href="{{ asset(config('fromSky.admin.path.assets').mix('website/css/vendor.css')) }}" rel="stylesheet">--}}
    <link href="{{ asset(config('fromSky.admin.path.assets').mix('css/app.css')) }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700&family=Saira+Semi+Condensed:wght@300;400;500&display=swap" rel="stylesheet">
{{--    <script src="https://widgets.coingecko.com/coingecko-coin-price-marquee-widget.js"></script>--}}

    {{--    <meta name="robots" content="noindex,nofollow">--}}
{{--    <meta name="googlebot" content="noindex,nofollow">--}}

    @include('website.partials.widgets_mobile_app')

    {{-- Google analytics tracking code --}}
    @include('website.partials.widgets_ga')

    {{-- Google recaptcha code --}}
{{--     @include('website.partials.widgets_captcha')--}}

    {{-- Iubenda banner code --}}
    {{-- @include('website.partials.iubenda_banner') --}}
    {{--    @livewireStyles--}}
</head>
<body class="bg-white-500 font-roboto text-sm leading-[16px] @yield('bodyBg','bg-[#F1F3F4]')">
    <div id="main" class="w-full transition-all">
        <header class="fixed top-0 left-0 z-50 flex-wrap items-center w-full bg-white">
            @include('website.partials.topnavbar')
             {{-- Navbar --}}
            @include('website.partials.navbar')
        </header>

        {{-- Page content --}}
        @yield('content')
        {{-- Footer --}}
        @if(isset($locale_page))
        <?php $locale_page = $locale_page ?? $page ?>
        <x-website.partials.footer :locale-page="$locale_page"/>
        @endif

    </div>
    {{-- default js to show in all pages --}}
    <script type="text/javascript">
        var urlAjaxHandler  = "{{ url_locale('/') }}";
        var _LANG           = "{{ get_locale() }}";
        var _WEBSITE_NAME	= "{!! config('fromSky.website.option.app.name')!!}";
        var imageScroll     = "{!! asset(config('fromSky.admin.path.assets').'website/images/up.png') !!}";
    </script>
    <script type="text/javascript" src="{{ asset(config('fromSky.admin.path.assets')).mix('/js/app.js') }}" defer></script>

    {{-- <script type="text/javascript" src="{{ asset(config('fromSky.admin.path.assets').mix('/website/js/slick.js')) }}" defer></script> --}}
     {{--<script type="text/javascript" src="/website/js/home/searchbox.js" defer></script>--}}
    @yield("footer_scripts")
    @stack('scripts')
    @yield('footerjs')

{{--    @livewireScripts--}}
</body>
</html>
