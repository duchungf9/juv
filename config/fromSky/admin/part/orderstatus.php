<?php
return [
    'model'             => 'OrderStatus',
    'title'             => 'Order Status',
    'icon'              => 'credit-card',
    'section'           => 'shop',
    'field'             => [
        'id',
        'title' => ['type' => 'text', 'field' => 'title'],
        'sort'  => ['type' => 'editable', 'field' => 'sort', 'orderable' => true, 'class' => 'col-1'],

        'is_active' => ['type' => 'boolean', 'field' => 'is_active', 'editable' => true],
    ],
    'orderBy'           => 'id',
    'orderType'         => 'ASC',
    'withRelation'      => [], // array
    'actions'           => [
        'edit'       => 1,
        'export_csv' => 0,
        'delete'     => 0,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 0
    ],
    'showMedia'         => 0,
    'showMediaCategory' => 0,
    'showMediaImages'   => 0,
    'showMediaDoc'      => 0,
    'showSeo'           => 0,
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'             => ['su']
];