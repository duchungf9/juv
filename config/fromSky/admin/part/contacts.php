<?php

return [
    'model'     => 'Contact',
    'icon'      => 'envelope',
    'title'     => 'Info Request',
    'section'   => 'users',
    'field'     => [
        'id',
        'email'      => ['type' => 'text', 'field' => 'email'],
        'name'       => ['type' => 'text', 'field' => 'name'],
        'surname'    => ['type' => 'text', 'field' => 'surname'],
        'company'    => ['type' => 'text', 'field' => 'company'],
        'message'    => ['type' => 'text', 'field' => 'message'],
        'product'    => ['type' => 'relation', 'relation' => 'product', 'field' => 'title'],
        'status'     => ['type' => 'boolean', 'field' => 'status', 'editable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'   => 'id',
    'orderType' => 'DESC',
    'actions'   => [
        'edit'       => 0,
        'delete'     => 0,
        'create'     => 0,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 0
    ],
    'password'  => 0,
    'menu'      => [
        'home'    => true,
        'top-bar' => [
            'show' => true
        ],
    ],
    'roles'     => ['su', 'admin', 'user']
];