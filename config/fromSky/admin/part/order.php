<?php
return [
    'model'            => 'Order',
    'title'            => 'Orders',
    'icon'             => 'shopping-cart',
    'section'          => 'shop',
    //'list_custom_header'=>'admin.list.order-big-amount',
    'field'            => [
        'id',
        'created_at'          => ['type' => 'date', 'field' => 'created_at', 'orderable' => true],
        'user'                => ['type' => 'text', 'field' => 'user_display', 'orderable' => true],
        'reference'           => ['type' => 'text', 'field' => 'reference', 'orderable' => true],
        'coupon'              => ['type' => 'text', 'field' => 'discount_code', 'class' => 'text-start'],
        //'products' => ['type' => 'text', 'field' => 'products_display', 'class' => 'text-start'],
        'products_cost'       => ['type' => 'text', 'field' => 'products_cost_display'],
        'total_cost'          => ['type' => 'text', 'field' => 'total_cost_display'],
        'payment'             => ['type' => 'text', 'field' => 'payment_method_display'],
        'payment_transaction' => ['type' => 'relation', 'relation' => 'payment', 'field' => 'transaction'],
        //'payment_date' => ['type' => 'relation', 'relation' => 'payment', 'field' => 'created_at'],
        'paid'                => ['type' => 'boolean', 'relation' => 'payment', 'model' => 'Payment', 'field' => 'is_paid', 'editable' => true],
        'status'              => [
            'type'        => 'relation',
            'relation'    => 'status',
            'model'       => 'OrderStatus',
            'foreign_key' => 'id',
            'label_key'   => 'title',
            'label_empty' => 'Seleziona Stato',
            'order_field' => 'sort',
            'field'       => 'status_id',
            'editable'    => true
        ],
    ],
    'field_searchable' => [
        /*
        * This is the 'relation' version which builds a dropdown input for the corresponding relation.
        * It should be only used when there are only a few records to show.
        */
        'status_id' => [
            'label'    => 'status',
            'type'     => 'relation',
            'model'    => 'OrderStatus',
            'relation' => 'status',
            'value'    => 'id',
            'field'    => 'title',
            'where'    => '1 = 1',
            'cssClass' => 'selectize',
        ],

        'from_date' => ['type' => 'date_range', 'label' => 'data_from', 'field' => 'created_at', 'class' => 'col-6 col-sm-1'],
        'to_date'   => ['type' => 'date_range', 'label' => 'data_to', 'field' => 'created_at', 'class' => 'col-6 col-sm-1'],
        'reference' => ['type' => 'text', 'label' => 'reference', 'field' => 'reference'],


    ],

    'orderBy'           => 'created_at',
    'orderType'         => 'DESC',
    'withRelation'      => ['payment'], // array
    'viewTemplate'      => 'fromsky_store::admin.views.order',
    'total'             => 'total_cost',
    'actions'           => [
        'edit'       => 0,
        'export_csv' => 0,
        'delete'     => 0,
        'create'     => 0,
        'copy'       => 0,
        'preview'    => 0,
        'view'       => 1,
        'view'       => 1,
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
            'action' => ['add']
        ],
    ],
    'roles'             => ['su', 'admin']
];