<?php

return [
    'model'           => 'Category',
    'title'           => 'Product Categories',
    'icon'            => 'list-alt',
    'section'         => 'cms',
    'field'           => [
        'id',
        'image'      => ['type' => 'image', 'field' => 'image'],
        'title'      => [
            'type'      => 'string',
            'field'     => 'title',
            'editable'  => false,
            'orderable' => true,
        ],
        'slug',
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort','orderable' => true,],
        'Parent'  => [
            'type'        => 'relation',
            'relation'    => 'parent',
            'model'       => 'Category',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'label_empty' => '-----',
            'order_field' => 'title',
            'field'       => 'parent_id',//parent_id
            'field_readonly' => 'title',//parent_id
            'editable'    => false,
            'orderable'   => true,
        ],
        'log_record' => [
            'type' => 'logrecord', 'field' => 'title', 'class' => 'col-3'
        ],
//                'created_at' => ['type' => 'date', 'field' => 'created_at'],
//                'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'         => 'id',
    'orderType'       => 'ASC',
    'actions'         => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia'       => 0,
    'showMediaImages' => 0,
    'showMediaDoc'    => 0,
    'showSeo'         => 1,
    'menu'            => [
        'home'    => false,
        'top-bar' => [
            'show'   => false,
            'action' => ['add']
        ],
    ],
    'roles'           => ['su', 'admin', 'user']
];