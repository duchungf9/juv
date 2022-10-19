<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="fromSky"/>
    <meta name="google-site-verification" content="{{data_get($site_settings,'GA_SITE_VERIFICATION')}}"/>
    <meta name="theme-color" content="{{data_get($site_settings,'THEME_COLOR')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Meta SEO --}}
    {!! SEO::generate() !!}
    <style type="text/css">
        body, html {
            padding: 0px;
            margin: 0px;
            background-image: url(" {!! asset(config('fromSky.admin.path.assets').'/website/images/coming_soon.jpg') !!}");
            background-size: cover;
            background-position: center;
            background-color: white;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>

</head>
<body>

<div class="container mx-auto sm:px-4 ">
    <div class="flex flex-wrap  text-center">
        <div class="sm:w-full pr-4 pl-4">
            <img class="center-block"
                 src="{!! asset(config('fromSky.admin.path.assets').'website/images/logo.png') !!}"
                 alt="{{ config('fromSky.website.option.app.name') }}">
        </div>
    </div>
</div>
</body>
</html>