@extends('website.app')
@section('content')
    <div id="map"></div>
    <section class="my-2">
        <div class="container mx-auto sm:px-4">
            <div class="flex flex-wrap ">
                <div class="w-full sm:w-1/2 pr-4 pl-4 md:w-1/3 pr-4 pl-4">
                    <address style="line-height: 1.75rem">
                        <h3 class="text-blue-600">{{ config('fromSky.website.option.app.name') }}</h3>
                        <div class="text-gray-700">
                            {{ config('fromSky.website.option.app.address') }}<br>
                            {{ config('fromSky.website.option.app.locality') }}<br>
                            {{ icon('phone', 'fa-rotate-90 fa-fw') }}
                            Tel {{ config('fromSky.website.option.app.phone') }}<br>
                            {{ icon('fax', 'fa-fw') }} Fax {{ config('fromSky.website.option.app.fax') }}<br>
                            {{ icon('envelope', 'fa-fw') }}
                            <a href="mailto:{{ config('fromSky.website.option.app.email') }}">
                                {{ config('fromSky.website.option.app.email') }}
                            </a>
                        </div>
                    </address>
                </div>
                <div class="w-full sm:w-1/2 pr-4 pl-4 md:w-2/3 pr-4 pl-4">
                    @include('website.form.contact')
                </div>
            </div>
        </div>
    </section>

@endsection
@section('footerjs')
    @parent
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key={{data_get($site_settings,'GMAPS_KEY')}}"></script>
    <script type="text/javascript">
        var marker_config =
                    @if(count($locations))  @json($locations)
            @else($locations)
        [
            [
                '{!! config('fromSky.website.option.app.name')!!}',	//title
                {{data_get($site_settings,'LAT')}},	// lat
                {{data_get($site_settings,'LNG')}},	// lng
                '{{asset(config('fromSky.admin.path.assets').'website/images/map_marker.png')}}',	// icon image
                "<div class='mapPop'><b>{!! config('fromSky.website.option.app.name')!!}</b><br>{!! config('fromSky.website.option.app.address')!!}<br>{!! config('fromSky.website.option.app.locality')!!}<br></div>", //popup window content
            ]
        ];
        @endif

        var gmap_config = {
            mapElement: 'map',
            zoomLevel: 12,
            mapStyles: [],
            marker_config: marker_config
        };
        jQuery(document).ready(function () {
            gMap.init();
        });
    </script>
@endsection
