<?php

return [
//    'paths' => ['api/*'],
'admin_path'       => env('CMS_ADMIN_PATH', 'admin'),
'time_cache'       => env('CMS_FRONT_TIME_CACHE', 1),
'time_cache_admin' => env('CMS_ADMIN_TIME_CACHE', 10),
'mail_host' => env('MAIL_HOST', ''),
];
