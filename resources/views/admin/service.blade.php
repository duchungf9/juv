<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="fromSky"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta name="robots" content="noindex,nofollow" />--}}
    <title>{{ config('fromSky.admin.option.title') }}</title>
    <link rel="icon" href="{{ asset('/favicon.jpg') }}" type="any" sizes="20x20">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400"/>
{{--    <link rel="stylesheet" href="{{ asset(config('fromSky.admin.path.common_css').'ma_helper.css') }}">--}}
    <link rel="stylesheet" href="{{ asset(config('fromSky.admin.path.assets').mix('cms/css/vendor.css')) }}">
    <link rel="stylesheet" href="{{ asset(config('fromSky.admin.path.assets').mix('cms/css/app.css')) }}">
</head>

<body class="login">
<div id="app">
    @yield('content')
</div>

@yield('footerjs')
</body>
</html>
