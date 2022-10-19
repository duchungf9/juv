<?php

return [
    'model'      => 'Metric',
    'title'      => 'Metrics',
    'icon'       => 'sort-numeric-up',
    'section'    => 'cms',
    'field'      => [
        'id',
        'title'      => ['type' => 'editable', 'field' => 'title', 'class' => 'col-2'],
        'value'      => ['type' => 'editable', 'field' => 'value', 'orderable' => true, 'class' => 'col-1'],
        'sort'       => ['type' => 'editable', 'field' => 'sort', 'orderable' => true, 'class' => 'col-1'],
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true, 'orderable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'edit'       => 1,
    'delete'     => 1,
    'create'     => 1,
    'copy'       => 0,
    'preview'    => 0,
    'view'       => 0,
    'selectable' => 1,
    'actions'    => [
        'edit'       => 1,
        'export_csv' => 0,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 1,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'menu'       => [
        'home'    => false,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'      => ['su', 'admin', 'user']
];