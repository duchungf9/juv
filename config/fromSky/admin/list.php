<?php

return [
    /**
     * Generic values are filled when when neither package was able to guess out the value.
     *
     * @var array
     */
    'item_per_pages' => 50,
    'section'        => [


        'product'           => require 'part/products.php',
        'orderstatus'           => require 'part/orderstatus.php',
        'order'           => require 'part/order.php',
        'news'           => require 'part/news.php',
        'media'          => require 'part/media.php',
        'tag'            => require 'part/tags.php',
        'ico'            => require 'part/ico.php',
        'newsattributes' => require 'part/newsattributes.php',
        'category'       => require 'part/categories.php',
        'widget'         => require 'part/widgets.php',
        'metric'         => require 'part/metrics.php',
        'faq'            => require 'part/faqs.php',


        /************************  USER Contact **********************/

//        'contact'     => require 'part/contacts.php',
        'social'      => require 'part/socials.php',
        'user'        => require 'part/users.php',
        'newsletter' => require 'part/newsletter.php',
        //        'locations'  => require 'part/locations.php',

        /************************  System and Role **********************/
        'page'        => require 'part/pages.php',
        'block'       => require 'part/blocks.php',
        'hpslider'    => require 'part/hpsliders.php',
        'setting'     => require 'part/settings.php',
        'template'    => require 'part/templates.php',
        'adminuser'   => require 'part/adminusers.php',
        'role'        => require 'part/roles.php',


        /************************  SHOP **********************/
        //        'project'             => require 'part/projects.php',
        //        'product'             => require 'part/products.php',
        //        'productmodel'        => require 'part/productmodels.php',
        //        'order'          => require 'part/order.php',
        //        'orderstatus'   => require 'part/orderstatus.php',
        //        'paymentmethod'  => require 'part/paymentmethods.php',
        //        'shipmentmethod' => require 'part/shipmentmethods.php',
        //        'discount'       => require 'part/discounts.php',

        /************************  LOCALIZATION **********************/
        'country'     => require 'part/countries.php',
//        'state'       => require 'part/states.php',
        //        'custom_url' => require 'part/custom_url.php',
        //        'custom_resources' => require 'part/custom_resources.php',
//        'example'     => require 'part/examples.php',
        //        'provinces'        => require 'part/provinces.php',
    ],
];
