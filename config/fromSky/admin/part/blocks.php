<?php

return [
    'model'             => 'Block',
    'title'             => 'Pages',
    'icon'              => 'newspaper',
    'section'           => 'cms',
    'field'             => ['id',
        'image'      => ['type' => 'image', 'field' => 'image'],
        'title'      => ['type' => 'text', 'field' => 'title', 'orderable' => true, 'order_field' => 'page_translations.title'],
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true, 'orderable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort', 'orderable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at', 'orderable' => true],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at', 'orderable' => true],
    ],
    'field_searchable'  => [],
    'actions'           => [
        'edit'       => 1,
        'export_csv' => 0,
        'delete'     => 1,
        'create'     => 0,
        'copy'       => 1,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia'         => 1,
    'showMediaCategory' => 1,
    'showMediaImages'   => 1,
    'showMediaDoc'      => 1,
    'showSeo'           => 0,
    'menu'              => [
        'home'    => false,
        'top-bar' => [
            'show'   => false,
            'action' => ['add']
        ],
    ],
    'roles'             => ['su', 'admin', 'user']
];