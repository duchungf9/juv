<?php

return [
    'model'     => 'Media',
    'title'     => 'Media & Video',
    'icon'      => 'file',
    'section'   => 'media',
    'field'     => [
        'id',
        'image'      => ['type' => 'image', 'field' => 'file_name'],
        'Type'      => ['type' => 'string', 'field' => 'collection_name'],
        'title',
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'is_home'        => ['type' => 'boolean', 'field' => 'is_home', 'editable' => true],
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
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'     => ['su','admin','user']
];