<?php

return [
    'model'             => 'Page',
    'title'             => 'Pages / Menu',
    'icon'              => 'newspaper',
    'section'           => 'cms',
    'field'             => ['id',
                            //                            'image'      => ['type' => 'image', 'field' => 'image'],
                            'title'      => [
                                'type'        => 'editable',
                                'field'       => 'title',
                                'order_field' => 'page_translations.title',
                                'class'       => 'col-2',
                                'editable'    => true,
                                'orderable'   => true,
                            ],
                            //                            'slug'       => ['type' => 'editable', 'field' => 'slug', 'orderable' => true, 'order_field' => 'page_translations.slug'],
                            'slug'       => ['type' => 'string', 'field' => 'slug', 'orderable' => true, 'order_field' => 'page_translations.slug'],
                            //                            'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true, 'orderable' => true],
                            'top_menu'   => ['type' => 'boolean', 'field' => 'top_menu', 'editable' => true,'orderable' => true,],
                            'sort'       => ['type' => 'editable', 'field' => 'sort', 'orderable' => true, 'class' => 'col-1'],
                            'parent'     => [
                                'type'     => 'relation',
                                'relation' => 'parent',
                                'field'    => 'title',
                                'order_field' => 'title',
                            ],
                            'log_record' => [
                                'type' => 'logrecord', 'field' => 'title', 'class' => 'col-3'
                            ],
                            //                            'created_at' => ['type' => 'date', 'field' => 'created_at', 'orderable' => true],
                            //                            'updated_at' => ['type' => 'date', 'field' => 'updated_at', 'orderable' => true],
    ],
    'field_searchable'  => [
        /*
         * This is the 'relation' version which builds a dropdown input for the corresponding relation1.
         * It should be only used when there are only a few records to show.
         */
        'parent_id' => [
            'label'    => 'parent',
            'type'     => 'relation',
            'model'    => 'page',
            'relation' => 'parent',
            'value'    => 'id',
            'field'    => 'title',
            'where'    => 'parent_id is null',
            'cssClass' => 'selectize',
        ],
        /**
         * This is the 'suggest' version which builds a dropdown handled by select 2 for the corresponding relation.
         * It should be used when there are a lot of records to filter.
         */
        /*'parent_id' => [
            'label'       => 'Parent page',
            'type'        => 'suggest',
            'model'       => 'page',
            'value'       => 'id',
            'caption'     => 'title',
            'is_accessor' => 0,
            'where'       => 'parent_id = 0',
        ],*/
        'title'     => ['type' => 'text', 'label' => 'title', 'field' => 'title'],
        'slug'      => ['type' => 'text', 'label' => 'slug', 'field' => 'slug'],
        'sort'      => ['type' => 'text', 'label' => 'sort', 'field' => 'sort'],
    ],
    'field_exportable'  => [
        'id'     => ['type' => 'integer', 'field' => 'id', 'label' => 'id'],
        'parent' => ['type' => 'relation', 'relation' => 'parent', 'field' => 'title', 'label' => 'parent'],
        'title'  => ['type' => 'text', 'label' => 'Title', 'field' => 'title'],
        'slug'   => ['type' => 'text', 'label' => 'Slug', 'field' => 'slug'],
        'sort'   => ['type' => 'text', 'label' => 'Sort', 'field' => 'sort'],
    ],
    'joinTable'         => "page_translations",
    'foreignJoinKey'    => 'page_id',
    'localJoinKey'      => 'id',
    'whereFilter'       => 'locale="en" ',
    'orderBy'           => 'sort,page_translations.title',
    'orderType'         => 'ASC',
    'withRelation'      => ['translations', 'parent.translations'], // array
    'actions'           => [
        'edit'       => 1,
        'export_csv' => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 1,
        'view'       => 0,
        'selectable' => 1,
    ],
    'showMedia'         => 0,
    'showBlock'         => 1,
    'showMediaCategory' => 0,
    'showMediaImages'   => 0,
    'showMediaDoc'      => 0,
    'editTemplate'      => 'admin.page.edit',
    'showSeo'           => 1,
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'help'              => "Default msg",
    'roles'             => ['su', 'admin', 'user']
];