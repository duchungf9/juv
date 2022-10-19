<?php

return [
    'model'             => 'Location',
    'title'             => 'Musei',
    'icon'              => 'university',
    'section'           => 'cms',
    'field'             => ['id',
        'image'      => ['type' => 'image', 'field' => 'image'],
        'title'      => ['type' => 'text', 'field' => 'title', 'orderable' => true, 'order_field' => 'page_translations.title'],
        'slug'       => ['type' => 'text', 'field' => 'slug', 'orderable' => true, 'order_field' => 'page_translations.slug'],
        'lat'        => ['type' => 'editable', 'field' => 'lat', 'orderable' => true],
        'lng'        => ['type' => 'editable', 'field' => 'lng', 'orderable' => true],
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true, 'orderable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort', 'orderable' => true],
        'created_at' => ['type' => 'date', 'field' => 'created_at', 'orderable' => true],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at', 'orderable' => true],
    ],
    'field_searchable'  => [
        'title' => ['type' => 'text', 'label' => 'title', 'field' => 'title'],
    ],
    'field_exportable'  => [
        'id'     => ['type' => 'integer', 'field' => 'id', 'label' => 'id'],
        'parent' => ['type' => 'relation', 'relation' => 'parent', 'field' => 'title', 'label' => 'parent'],
        'title'  => ['type' => 'text', 'label' => 'Title', 'field' => 'title'],
        'slug'   => ['type' => 'text', 'label' => 'Slug', 'field' => 'slug'],
        'sort'   => ['type' => 'text', 'label' => 'Sort', 'field' => 'sort'],
    ],
    'joinTable'         => "location_translations",
    'foreignJoinKey'    => 'location_id',
    'localJoinKey'      => 'id',
    'whereFilter'       => 'locale="en"',
    'orderBy'           => 'sort,location_translations.title',
    'orderType'         => 'ASC',
    'withRelation'      => ['translations'], // array
    'actions'           => [
        'edit'       => 1,
        'export_csv' => 0,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 1,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia'         => 1,
    'showBlock'         => 0,
    'showMediaCategory' => 1,
    'showMediaImages'   => 1,
    'showMediaDoc'      => 0,
    'showSeo'           => 0,
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'             => ['su', 'admin', 'user']
];