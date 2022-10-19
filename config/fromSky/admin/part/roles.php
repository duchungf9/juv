<?php

return [
    'model'   => 'Role',
    'icon'    => 'graduation-cap',
    'title'   => 'Roles',
    'section' => 'users',
    'field'   => [
        'id',
        'name'         => ['type' => 'string', 'field' => 'name'],
        'display_name' => ['type' => 'string', 'field' => 'display_name'],
        'description'  => ['type' => 'text', 'field' => 'description'],
        'level'        => ['type' => 'string', 'field' => 'level'],
        'created_at'   => ['type' => 'date', 'field' => 'created_at'],
        'updated_at'   => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'actions' => [
        'edit'       => 0,
        'delete'     => 0,
        'create'     => 0,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 0
    ],
    'menu'    => [
        'home'    => false,
        'top-bar' => [
            'show'   => false,
            'action' => ['add']
        ],
    ],
    'roles'   => ['su']
];