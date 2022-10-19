<?php
return [
    'model'     => 'AdminUser',
    'icon'      => 'users',
    'title'     => 'Admin',
    'field'     => [
        'id',
        'email'      => ['type' => 'editable', 'field' => 'email'],
        'first_name' => ['type' => 'editable', 'field' => 'first_name'],
        'last_name'  => ['type' => 'editable', 'field' => 'last_name'],
        'is_active'  => ['type' => 'boolean', 'field' => 'is_active', 'editable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'password'  => 1,
    'orderBy'   => 'first_name',
    'orderType' => 'ASC',
    'actions'   => ['edit'       => 1,
                    'delete'     => ['roles' => ['su', 'admin']],
                    'create'     => ['roles' => ['su', 'admin']],
                    'copy'       => 0,
                    'preview'    => 0,
                    'view'       => 0,
                    'selectable' => ['roles' => ['su', 'admin']],

                    'impersonated' => ['roles' => ['su', 'admin']]
    ],
    'menu'      => [
        'tool' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'     => ['su', 'admin']
];