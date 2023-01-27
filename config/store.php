<?php

return [

    'store_path' => 'store',
    'use_default_landing_page' => true,

    // views:
    'product_show_blade' => 'store::product.show',

    'models' => [
        'product' => 'AscentCreative\Store\Models\Product',
    ],
    
    'controllers' => [
        'admin' => [
            'product' => 'AscentCreative\Store\Controllers\Admin\ProductController',
        ],
        'public' => [
            'product' => 'AscentCreative\Store\Controllers\ProductController',
        ],
       
    ],
    
];
