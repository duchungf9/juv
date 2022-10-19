<?php

return [
    'model'     => 'HpSlider',
    'title'     => 'Quỹ đầu tư',
    'icon'      => 'image',
    'section'   => 'cms',
    'field'     => [
        'id',
        'image'      => ['type' => 'image', 'field' => 'image'],
        'title',
        'is_active'  => ['type' => 'boolean', 'field' => 'is_active', 'editable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort'],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'   => 'sort',
    'orderType' => 'ASC',
    'actions'   => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 1,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'menu'      => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'     => ['su', 'admin', 'user']
];