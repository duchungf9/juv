<?php
return [
    'model'            => 'Country',
    'title'            => 'Country',
    'icon'             => 'globe-africa',
    'field'            => [
        'id',
        'name' => ['type' => 'string', 'field' => 'name', 'orderable' => true],

        'iso_code'   => ['type' => 'string', 'field' => 'iso_code', 'orderable' => true],
        'vat'        => ['type' => 'string', 'field' => 'vat'],
        'eu'         => ['type' => 'boolean', 'field' => 'eu'],
        'is_active'  => ['type' => 'boolean', 'field' => 'is_active', 'editable' => true],
        'updated_at' => ['type' => 'date', 'field' => 'updated_at'],
    ],
    'field_searchable' => [
        'name'     => ['type' => 'text', 'label' => 'name', 'field' => 'name'],
        'iso_code' => ['type' => 'text', 'label' => 'code', 'field' => 'iso_code'],
    ],
    'orderBy'          => 'name',
    'orderType'        => 'ASC',
    'actions'          => [
        'edit'       => 1,
        'delete'     => 0,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 1,
        /* GF_ma  custom  view
        'editTemplate' =>'admin.special.edit_audit',
        'viewTemplate' =>'admin.special.view_audit',
        */
        'selectable' => 1
    ],
    'showMedia'        => 0,
    'showSeo'          => 0,
    'menu'             => [
        'home'    => false,
        'top-bar' => [
            'show'   => true,
            'action' => ['add']
        ],
    ],
    'roles'            => ['su']
];