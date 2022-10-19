<?php

return [
    'model'            => 'User',
    'icon'             => 'users',
    'title'            => 'Users',
    'section'          => 'users',
    'field'            => [
        'id',
        'email'      => ['type' => 'editable', 'field' => 'email'],
        'first_name' => ['type' => 'editable', 'field' => 'firstname'],
        'last_name'  => ['type' => 'editable', 'field' => 'lastname'],
        'is_active'  => ['type' => 'boolean', 'field' => 'is_active', 'editable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'field_searchable' => [
        'email'     => ['type' => 'text', 'label' => 'email', 'field' => 'email'],
        'firstname' => ['type' => 'text', 'label' => 'first_name', 'field' => 'firstname'],
        'lastname'  => ['type' => 'text', 'label' => 'last_name', 'field' => 'lastname'],
    ],
    'orderBy'          => 'firstname',
    'orderType'        => 'ASC',
    'actions'          => [
        'edit'         => 1,
        'delete'       => 1,
        'create'       => 1,
        'copy'         => 0,
        'preview'      => 0,
        'view'         => 0,
        'impersonated' => 1,
        'selectable'   => 1
    ],
    'password'         => 1,
    'menu'             => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'            => ['su', 'admin']
];