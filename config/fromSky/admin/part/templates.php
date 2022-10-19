<?php

return [
    'model'     => 'Template',
    'title'     => 'Template',
    'icon'      => 'feather-alt',
    'field'     => [
        'id',
        'template',
        'title',
        'value'      => ['type' => 'editable', 'field' => 'value'],
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort'],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'   => 'template',
    'orderType' => 'ASC',
    'actions'   => [
        'edit'       => 1,
        'delete'     => 0,
        'create'     => 1,
        'copy'       => 1,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia' => 0,
    'showSeo'   => 0,
    'menu'      => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'     => ['su']
];