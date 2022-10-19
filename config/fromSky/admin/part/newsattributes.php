<?php

return [
    'model'           => 'NewsAttributes',
    'title'           => 'Review Coin Attributes',
    'icon'            => 'folder',
    'section'         => 'cms',
    'field'           => [
        'id',
        //'parent' => ['type' => 'relation', 'relation' => 'parentCategory', 'field' => 'title'],
        //                'image'      => ['type' => 'image', 'field' => 'image'],
        'news'   => [
            'type'        => 'relation',
            'relation'    => 'news',
            'model'       => 'News',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'label_empty' => '-----',
            'order_field' => 'sort',
            'field'       => 'news_id',
            'editable'    => true,
            'orderable'   => true,
        ],
        'title' => ['type' => 'editable', 'field' => 'title'],
        'type',
        'field' => ['type' => 'string', 'field' => 'field'],
        'default',
        'pub'   => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
    ],
    'orderBy'         => 'sort',
    'orderType'       => 'ASC',
    'actions'         => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 1,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia'       => 0,
    'showMediaImages' => 0,
    'showMediaDoc'    => 0,
    'showSeo'         => 0,
    'menu'            => [
        'home'    => false,
        'top-bar' => [
            'show'   => false,
            'action' => ['add']
        ],
    ],
    'roles'           => ['su', 'admin', 'user']
];