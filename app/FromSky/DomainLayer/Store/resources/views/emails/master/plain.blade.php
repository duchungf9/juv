[{{ config('app.name') }}]({{ config('app.url') }})

@yield('content')

© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')

{{ config('fromSky.website.option.email.footer') }}
