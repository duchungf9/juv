<?php

return [
    'model'     => 'State',
    'icon'      => 'flag',
    'title'     => 'State',
    'field'     => [
        'id',
        'country'    => ['type' => 'relation', 'field' => 'name', 'relation' => 'country'],
        'title'      => ['type' => 'editable', 'field' => 'title'],
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'   => 'title',
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
    'menu'      => [
        'home'    => false,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'     => ['su']
];