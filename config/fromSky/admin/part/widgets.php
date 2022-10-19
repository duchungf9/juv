<?php

return [
    'model'             => 'Widget',
    'title'             => 'Widgets',
    'icon'              => 'gift',
    'section'           => 'cms',
    'field'             => ['id',
                            'image'      => ['type' => 'image', 'field' => 'image'],
                            'code'       => ['type' => 'text', 'field' => 'code', 'orderable' => true],
                            'title'      => ['type' => 'text', 'field' => 'title', 'orderable' => true, 'order_field' => 'page_translations.title'],
//                            'category'   => [
//                                'type'        => 'relation',
//                                'relation'    => 'category',
//                                'model'       => 'Category',
//                                'filter'      => ['model_type' => \App\Model\Widget::class],
//                                'foreign_key' => 'id',
//                                'label_key'   => 'title',
//                                'label_empty' => '-----',
//                                'order_field' => 'sort',
//                                'field'       => 'category_id',
//                                'editable'    => true,
//                                'orderable'   => true,
//                            ],
                            'pub'        => ['type' => 'boolean', 'field' => 'is_active', 'editable' => true, 'orderable' => true],
                            'sort'       => ['type' => 'editable', 'field' => 'sort', 'orderable' => true],
                            'created_at' => ['type' => 'date', 'field' => 'created_at', 'orderable' => true],
                            'updated_at' => ['type' => 'date', 'field' => 'updated_at', 'orderable' => true],
    ],
    'actions'           => [
        'edit'       => 1,
        'export_csv' => 0,
        'delete'     => ['roles' => ['su']],
        'create'     => ['roles' => ['su']],
        'copy'       => ['roles' => ['su']],
        'preview'    => 0,
        'view'       => 0,
        'selectable' => 0
    ],
    'showMedia'         => 0,
    'showMediaCategory' => 0,
    'showMediaImages'   => 0,
    'showMediaDoc'      => 0,
    'showSeo'           => 0,
    'menu'              => [
        'home'    => true,
        'top-bar' => [
            'show'   => true,
            'action' => ['add'],
            /*'submodel' => [
                'category' => ['label' => 'News Widget Categories','section'=>'widget', 'model' => 'category', 'add' => 1, 'icon' => 'list-alt' , 'context'=>[
                    'model'=>\App\Model\Widget::class, 'field'=>'model_type'
                ]],
            ],*/
        ],
    ],
    'roles'             => ['su', 'admin', 'user']
];