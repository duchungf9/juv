<?php

return [
    'model'   => 'Tag',
    'title'   => 'TagsNews',
    'icon'    => 'tag',
    'section' => 'cms',
    'field'   => [
        'id',
        'title',
        'slug',
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'actions' => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],

    'showSeo'           => 1,

    'menu'    => [
        'home'    => true,
        'top-bar' => [
            'show'   => false,
            'action' => ['add']
        ],
    ],
    'roles'   => ['su', 'admin', 'user']
];