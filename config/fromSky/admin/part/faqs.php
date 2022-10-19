<?php

return [
    'model'             => 'Faq',
    'title'             => 'Faqs',
    'icon'              => 'question',
    'section'           => 'cms',
    'field'             => [
        'id',
        'title',
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort'],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'           => 'sort',
    'orderType'         => 'ASC',
    'edit'              => 1,
    'delete'            => 1,
    'create'            => 1,
    'copy'              => 0,
    'preview'           => 0,
    'view'              => 0,
    'selectable'        => 1,
    'showMedia'         => 0,
    'showMediaCategory' => 0,
    'showMediaImages'   => 0,
    'showMediaDoc'      => 0,
    'showSeo'           => 0,
    'actions'           => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add'],
            /*'submodel' => [
                'categories' => ['label' => 'Product Categories', 'model' => 'category', 'add' => 1],
                'productmodels' => ['label' => 'Models', 'model' => 'productmodel', 'add' => 1]
            ]*/
        ],
    ],
];