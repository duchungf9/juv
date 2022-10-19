<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => config('fromSky.website.option.app.name'), // set false to total remove
            'description'  => '', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description' => false, // set false to total remove
            'url'         => false,
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [

        ],
    ],
    /**
     *   fromSky custom settings
     */
    'lara_setting' => [
        'title' => '65',
        'description' => '160'
    ],
];
