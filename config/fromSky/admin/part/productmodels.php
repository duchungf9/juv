<?php

return [
    'model'     => 'ProductModel',
    'title'     => 'Models',
    'icon'      => 'folder',
    'section'   => 'cms',
    'field'     => [
        'id',
        'image'   => ['type' => 'image', 'field' => 'image'],
        'product' => ['type' => 'relation', 'field' => 'title', 'relation' => 'product'],
        'title',
        'pub'     => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'sort'    => ['type' => 'editable', 'field' => 'sort'],
    ],
    'orderBy'   => 'product_id',
    'orderType' => 'ASC',
    'actions'   => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia' => 0,
    'showSeo'   => 0,
    'menu'      => [
        'home'    => false,
        'top-bar' => [
            'show'   => false,
            'action' => ['add']
        ],
    ],
    'roles'     => ['su', 'admin', 'user']
];