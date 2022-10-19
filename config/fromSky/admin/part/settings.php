<?php

return [
    'model'     => 'Setting',
    'title'     => 'Setting',
    'icon'      => 'wrench',
    'field'     => [
        'id',
        'template',
        'key'         => ['type' => 'editable', 'field' => 'key'],
        'value'       => ['type' => 'editable', 'field' => 'value'],
        'description' => ['type' => 'string', 'field' => 'description'],
        'created_at'  => ['type' => 'date', 'field' => 'created_at'],
        'updated_at'  => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'   => '\'key\'',
    'orderType' => 'ASC',
    'actions'   => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 1,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1,
    ],
    'showMedia' => 0,
    'showSeo'   => 0,
    'menu'      => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add'],
        ],
    ],
    'roles'     => ['su'],
];
