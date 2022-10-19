<?php
return [
    'model'             => 'Discount',
    'title'             => 'Discount',
    'icon'              => 'tags',
    'section'           => 'shop',
    'field'             => [
        'id',
        'id',
        'code'              => ['type' => 'text', 'field' => 'code', 'orderable' => true],
        'amount'            => ['type' => 'text', 'field' => 'label'],
        'date_start'        => ['type' => 'text', 'field' => 'date_start', 'orderable' => true],
        'date_end'          => ['type' => 'text', 'field' => 'date_end', 'orderable' => true],
        'uses'              => ['type' => 'text', 'field' => 'uses', 'orderable' => true],
        'available_display' => ['type' => 'false', 'field' => 'available_display', 'orderable' => true],
        'pub'               => ['type' => 'boolean', 'field' => 'is_active', 'orderable' => true, 'editable' => true],
    ],
    'orderBy'           => 'created_at',
    'orderType'         => 'DESC',
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
    'roles'             => ['su', 'admin']
];