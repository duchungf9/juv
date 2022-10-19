<?php

return [
    'model'            => 'Province',
    'icon'             => 'flag',
    'title'            => 'Province',
    'field'            => [
        'id',
        'state'      => ['type' => 'relation', 'field' => 'title', 'relation' => 'state'],
        'code'       => ['type' => 'editable', 'field' => 'code'],
        'title'      => ['type' => 'editable', 'field' => 'title'],
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'field_searchable' => [
        'title' => ['type' => 'text', 'label' => 'title', 'field' => 'title'],
    ],
    'field_exportable' => [
        'id'    => ['type' => 'integer', 'field' => 'id', 'label' => 'id'],
        'title' => ['type' => 'text', 'label' => 'Title', 'field' => 'title'],
        'code'  => ['type' => 'text', 'label' => 'Code', 'field' => 'code'],

    ],
    'orderBy'          => 'title',
    'orderType'        => 'ASC',
    'actions'          => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'export_csv' => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'menu'             => [
        'home'    => false,
        'top-bar' => [
            'show'   => false,
            'action' => ['add']
        ],
    ],
    'roles'            => ['su']
];