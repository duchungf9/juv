<?php
return [
    'model'             => 'PaymentMethod',
    'title'             => 'Payment Methods',
    'icon'              => 'credit-card',
    'section'           => 'shop',
    'field'             => [
        'id',
        'title'     => ['type' => 'text', 'field' => 'title'],
        'fee'       => ['type' => 'text', 'field' => 'fee'],
        'code'      => ['type' => 'text', 'field' => 'code'],
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