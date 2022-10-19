<?php

return  [
    'model'             => 'Product',
    'title'             => 'Product',
    'icon'              => 'cube',
    'section'           => 'cms',
    'field'             => [
        'id',
        'category'   => ['type' => 'relation', 'relation' => 'category', 'field' => 'title'],
        'image'      => ['type' => 'image', 'field' => 'image'],
        'title',
        'price',
        'full_price',
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'on_sale'    => ['type' => 'boolean', 'field' => 'on_sale', 'editable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort'],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'           => 'sort',
    'orderType'         => 'ASC',
    'actions'           => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 1,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia'         => 1,
    'showMediaCategory' => 0,
    'showMediaImages'   => 1,
    'showMediaDoc'      => 1,
    'showSeo'           => 1,
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'     => true,
            'action'   => ['add'],
            'submodel' => [
                'categories'    => ['label' => 'Product Categories', 'model' => 'category', 'add' => 1, 'icon' => 'folder'],
                'productmodels' => ['label' => 'Models', 'model' => 'productmodel', 'add' => 1, 'icon' => 'folder']
            ]
        ],
    ],
    'roles'             => ['su', 'admin', 'user']
];