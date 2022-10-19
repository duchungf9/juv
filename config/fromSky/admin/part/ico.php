<?php

return [
    'model'             => 'Ico',
    'title'             => 'Ico',
    'icon'              => 'coins',
    'section'           => 'cms',
    'use_attrib'        => true,
    //    'editTemplate'      => 'admin.reviewcoins.edit_review_coins',
    'field'             => [
        'ico_image'         => ['type' => 'image', 'field' => 'ico_image'],
        'name',
        'token_sale'        => [
            'type'      => 'text',
            'field'     => 'token_sale',
            'editable'  => true,
            'orderable' => true,
        ],
        'sale_in', // datetime nhé
        'goal',// mục tiêu
        'type',
        'ticker',
        'token_type',
        'token_price',
        'total_token',
//        'know_your_customer', //KYC là viết tắt của cụm từ Know Your Customer - Nhận biết khách hàng của bạn. Đây là một quy trình nhằm xác minh danh tính của khách hàng khi tham gia vào các dịch vụ của ngân hàng như mở tài khoản, rút tiền, gửi tiền…
        'id',
    ],
    'orderBy'           => 'sort',
    'orderType'         => 'ASC',
    'actions'           => [
        'edit'       => 1,
        'delete'     => 1,
        'create'     => 1,
        'copy'       => 0,
        'preview'    => 1,
        'view'       => 0,
        'selectable' => 1
        //                'viewTemplate' =>'admin.reviewcoins.view_audit',
    ],
    'showMedia'         => 1,
    'showMediaCategory' => 0,
    'showMediaImages'   => 1,
    'showMediaDoc'      => 1,
    'showSeo'           => 1,
    'showModelAttr'     => 1,
    'tabs'              => [
//        'review_attributes' => ['title' => 'attributes_model', 'icon' => 'fa-review', 'context' => 'model_attributes'],
    ],
    'menu'              => [
        'home'    => false,
        'top-bar' => [
            'show'     => false,
            'action'   => ['add'],
            'submodel' => [
//                'categories'           => ['label' => 'Product Categories', 'model' => 'category', 'add' => 1, 'icon' => 'list'],
//                'reviewcoinattributes' => ['label' => 'Models', 'model' => 'reviewcoinattributes', 'add' => 1, 'icon' => 'coins']
            ]
        ],
    ],
    'roles'             => ['su', 'admin', 'user','ctv']
];