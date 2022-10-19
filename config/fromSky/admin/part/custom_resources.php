<?php

return [
    'model'            => 'Example',
    'title'            => 'Custom Items',
    'icon'             => 'graduation-cap',
    'section'          => 'example',
    'extra_url'        => 'custom_resources',
    'field'            => [
        'id',
        'date'   => ['type' => 'text', 'field' => 'date', 'orderable' => true],
        'page'   => ['type' => 'relation', 'relation' => 'page', 'field' => 'title'],
        'page_2' => [
            'type'        => 'relation',
            'relation'    => 'page_2',
            'field'       => 'title',
            'orderable'   => true,
            'order_field' => 'page_translations.title',
            'roles'       => ['su', 'admin']
        ],
        'image'  => ['type' => 'image', 'field' => 'image'],
        //'image_media_id' => ['type' => 'relation_image', 'relation' => 'imageMedia', 'field' => 'file_name'],
        'title'  => ['type' => 'text', 'field' => 'title', 'orderable' => true],
        'slug'   => ['type' => 'text', 'field' => 'slug', 'orderable' => true, 'order_field' => 'page_translations.title'],
        'pub'    => ['type' => 'boolean', 'field' => 'pub', 'orderable' => true, 'editable' => false],
        'sort'   => ['type' => 'editable', 'field' => 'sort', 'orderable' => true],

        'created_at' => ['type' => 'date', 'field' => 'created_at', 'orderable' => true],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at', 'orderable' => true],
    ],
    'field_searchable' => [
        /*
        * This is the 'relation' version which builds a dropdown input for the corresponding relation.
        * It should be only used when there are only a few records to show.
        */
        'page_id'   => [
            'label'    => 'page',
            'type'     => 'relation',
            'model'    => 'page',
            'relation' => 'page',
            'value'    => 'id',
            'field'    => 'title',
            'where'    => '1 = 1',
            'cssClass' => 'selectize',
        ],
        /**
         * This is the 'suggest' version which builds a dropdown handled by select 2 for the corresponding relation.
         * It should be used when there are a lot of records to filter.
         */
        'page_2_id' => [
            'label'       => 'page_2',
            'type'        => 'suggest',
            'model'       => 'page',
            'value'       => 'id',
            'caption'     => 'title',
            'is_accessor' => 0,
            'where'       => '1 = 1',
            'roles'       => ['su', 'admin']
        ],
        //'date'   => ['type' => 'date', 'label' => 'date_format', 'field' => 'date'],
        'from_date' => ['type' => 'date_range', 'label' => 'data_from', 'field' => 'date', 'class' => 'col-6 col-sm-1'],
        'to_date'   => ['type' => 'date_range', 'label' => 'data_to', 'field' => 'date', 'class' => 'col-6 col-sm-1'],
        'title'     => ['type' => 'text', 'label' => 'title', 'field' => 'title'],
        'slug'      => ['type' => 'text', 'label' => 'slug', 'field' => 'slug'],
        'sort'      => ['type' => 'number', 'label' => 'sort', 'field' => 'sort', 'mode' => 'strict'],
    ],
    'field_exportable' => [
        'id'     => ['type' => 'integer', 'field' => 'id', 'label' => 'id'],
        'parent' => ['type' => 'relation', 'relation' => 'parent', 'field' => 'title', 'label' => 'parent'],
        'title'  => ['type' => 'text', 'label' => 'Title', 'field' => 'title'],
        'slug'   => ['type' => 'text', 'label' => 'Slug', 'field' => 'slug'],
        'sort'   => ['type' => 'text', 'label' => 'Sort', 'field' => 'sort'],
    ],
    'joinTable'        => "page_translations",
    'foreignJoinKey'   => 'page_id',
    'localJoinKey'     => 'id',
    'joinFields'       => ['page_translations.id as trans_id'],
    'whereFilter'      => 'page_translations.locale="en" ',
    'orderBy'          => 'page_translations.title,sort',
    'orderType'        => 'ASC',
    'withRelation'     => ['media'],
    'actions'          => [
        'edit'       => 0,
        'selectable' => ['roles' => ['su', 'admin']],
    ],
    'viewTemplate'     => 'admin.views.example',
    'showMedia'        => 1,
    'showMediaCropper' => 1,
    'mediaCropper'     => [
        'width'     => 400,
        'height'    => 400,
        'ratio'     => 1,
        'fill'      => 'transparent',
        'format'    => 'jpeg',
        'extension' => 'jpg'
    ],
    'menu'             => [
        'home'    => false,
        'top-bar' => [
            'show' => false,

        ],
    ],
    'roles'            => ['su', 'admin', 'user']
];