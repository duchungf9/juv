<?php

return [
    'model'     => 'Newsletter',
    'title'     => 'Newsletter',
    'icon'      => 'envelope-open-text',
    'section'   => 'users',
    'field'     => [
        'id',
        'locale'     => ['type' => 'image', 'field' => 'locale'],
        'email',
        'coupon'     => ['type' => 'text', 'field' => 'coupon_code'],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
    ],
    'orderBy'   => 'created_at',
    'orderType' => 'DESC',
    'actions'   => [
        'edit'       => 0,
        'delete'     => 1,
        'create'     => 0,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia' => 0,
    'showSeo'   => 0,
    'menu'      => [
        'home'    => true,
        'top-bar' => [
            'show' => true,
        ],
    ],
    'roles'     => ['su', 'admin']
];