<?php

return  [
    'model'             => 'Project',
    'title'             => 'Project',
    'icon'              => 'project-diagram',
    'section'           => 'cms',
    'field'             => [
        'id',
        'category' => ['type' => 'relation', 'relation' => 'category', 'field' => 'title'],
        'tags'     => ['type' => 'relation', 'relation' => 'tags', 'field' => 'title', 'multiple' => true],

        'image'      => ['type' => 'image', 'field' => 'image'],
        'title',
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true],
        'sort'       => ['type' => 'editable', 'field' => 'sort'],
        'created_at' => ['type' => 'date', 'field' => 'created_at'],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'orderBy'           => 'sort',
    'orderType'         => 'ASC',
    'actions'           => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 1
    ],
    'showMedia'         => 1,
    'showMediaCategory' => 0,
    'showMediaImages'   => 1,
    'showMediaDoc'      => 1,
    'showSeo'           => 1,
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'     => true,
            'action'   => ['add'],
            'submodel' => [
                'categories' => ['label' => 'Product Categories', 'model' => 'category', 'add' => 1, 'icon' => 'folder'],
            ]
        ],
    ],
    'roles'             => ['su', 'admin', 'user']
];