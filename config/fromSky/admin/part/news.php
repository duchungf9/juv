<?php

return [
    'model'            => 'News',
    'title'            => 'News',
    'icon'             => 'bullhorn',
    'section'          => 'cms',
    'use_attrib'       => true,
    'field'            => [
        'id'      => [
            'type'      => 'string',
            'field'     => 'id',
            'editable'  => false,
            'orderable' => true,
        ],
        'image'      => ['type' => 'image', 'field' => 'image'],
        //                'image' => ['type' => 'relation_image', 'relation' => 'imageMedia', 'field' => 'file_name'],
        //                'image_txt' => ['type' => 'relation_image', 'relation' => 'imageMedia', 'field' => 'file_name'],
        //                'category'   => ['type' => 'relation', 'relation' => 'category', 'field' => 'title'],
        'title'      => [
            'type'      => 'string',
            'field'     => 'title',
            'editable'  => true,
            'orderable' => true,
        ],
        /*'slug'       => [
            'type'      => 'string',//editable
            'field'     => 'slug',
            'editable'  => false,
            'orderable' => true,
        ],*/
        //        'tags'                  => ['type' => 'relation', 'relation' => 'tags', 'field' => 'title', 'multiple' => true, 'orderable' => true],
        'pub'        => ['type' => 'boolean', 'field' => 'pub', 'editable' => true, 'orderable' => true, 'roles' => ['su', 'admin']],
        'is_home'    => ['type' => 'boolean', 'field' => 'is_home', 'editable' => true, 'orderable' => true, 'roles' => ['su', 'admin']],
        'is_pin'     => ['type' => 'boolean', 'field' => 'is_pin', 'editable' => true, 'orderable' => true, 'roles' => ['su', 'admin']],
        'category'   => [
            'type'           => 'relation',
            'relation'       => 'category',// relation phai co trong Model moi co tac dung
            'model'          => 'Category',
            //            'filter'      => ['model_type' => \App\Model\News::class],
            //                    'scopes'      => ['published'],
            'foreign_key'    => 'id',
            'label_key'      => 'title',
            'label_empty'    => '------',
            'order_field'    => 'title',
            'field'          => 'category_id',
            'field_readonly' => 'title',
            'editable'       => false, // if true => 'field' phai la truong category_id (khoa ngoai) con false thi no se la 'title' ten truong bang lien ket
            'orderable'      => true,
        ],
        'sort'       => ['type' => 'editable', 'field' => 'sort', 'orderable' => true],
        'log_record' => [
            'type' => 'logrecord', 'field' => 'title', 'class' => 'col-3',
        ],
        //                'created_at' => ['type' => 'date', 'field' => 'created_at'],
        //                'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'export_csv'       => 1,
    'field_exportable' => [
        'id'         => ['type' => 'integer', 'field' => 'id', 'label' => 'id'],
        'date'       => ['type' => 'text', 'field' => 'date', 'label' => 'date'],
        'title'      => ['type' => 'text', 'label' => 'Title', 'field' => 'title'],
        'slug'       => ['type' => 'text', 'label' => 'Slug', 'field' => 'slug'],
        'sort'       => ['type' => 'text', 'label' => 'Sort', 'field' => 'sort'],
        'created_at' => ['type' => 'datetime', 'label' => 'created_at', 'field' => 'created_at'],
    ],
    'field_searchable' => [
        'from_date' => ['type' => 'date_range', 'label' => 'data_from', 'field' => 'date', 'class' => 'col-6 col-sm-1'],
        'to_date'   => ['type' => 'date_range', 'label' => 'data_to', 'field' => 'date', 'class' => 'col-6 col-sm-1'],
        'title'     => ['type' => 'text', 'label' => 'title', 'field' => 'title'],
        'category'  => [
            'type'     => 'relation',
            'model'    => 'category',
            'relation' => 'category',
            'label'    => 'category',
            'value'    => 'id',
            'field'    => 'title',
            'cssClass' => 'selectize',
        ],
        'tags'      => [
            'label'    => 'search_by_tags',
            'type'     => 'relation',
            'model'    => 'tag',
            'relation' => 'tags',
            'value'    => 'id',
            'field'    => 'title',
            'cssClass' => 'selectize',
        ],

    ],
    'orderBy'          => 'date',
    'orderType'        => 'desc',

    'actions' => [
        'edit'       => 1,
        'delete'     => ['roles'=>['su','admin']],
        'create'     => 1,
        'copy'       => 1,
        'preview'    => 1,
        'view'       => 0,
        'selectable' => 1,
    ],

    'showMedia'         => 0,
    'showMediaCategory' => 0,
    'showMediaImages'   => 0,
    'showMediaDoc'      => 0,
    'showBlock'         => 1,
    'showSeo'           => 1,
    'tabs'              => [
        'review_attributes' => ['title' => 'attributes_model', 'icon' => 'fa-review', 'context' => 'model_attributes'],
    ],
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'     => true,
            'action'   => ['add'],
            'submodel' => [
                'category'       => ['label' => 'Danh mục tin', 'model' => 'category', 'add' => 1, 'icon' => 'list-alt'],
                'tag'            => ['label' => 'Tags', 'model' => 'tags', 'add' => 1, 'icon' => 'tag'],
//                'newsattributes' => ['label' => 'Dynamic attirbutes', 'model' => 'newsattributes', 'add' => 1, 'icon' => 'list'],
            ],
        ],
    ],
    'roles'             => ['su', 'admin', 'user', 'ctv'],
];
