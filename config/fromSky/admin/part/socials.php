<?php

return [
    'model'     => 'Social',
    'icon'      => 'share-alt',
    'title'     => 'Social',
    'section'   => 'cms',
    'field'     => [
        'id',
        'title'      => ['type' => 'editable', 'field' => 'title'],
        'icon'       => ['type' => 'editable', 'field' => 'icon'],
        'link'       => ['type' => 'editable', 'field' => 'link'],
        'is_active'  => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
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
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'menu'      => [
        'home' => true,
        'top-bar' => [
            'show'   => true,
//            'action' => ['add']
        ],
    ],
    'roles'     => ['su', 'admin', 'user']
];