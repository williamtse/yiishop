<?php

global $menus;

$menus = [
    'site' => [
        'icon_class' => 'dashicons-dashboard',
        'icon-font' => '\f226',
        'url' => 'site/index',
        'text' => '仪表盘',
        'is_first_item'=> 1,
        'hook' => 'hook_menu_after_site',
        'submenus' => [
            ['site/index','首页',['site/index','site/updatecore'],'hook_submenu_after_site_index'],
            ['site/updatecore','更新',['site/updatecore'],'hook_submenu_after_site_updatecore']
        ]
    ],
    'product' => [
        'icon_class' => 'dashicons-admin-product',
        'icon-font' => '\f174',
        'url' => 'product/index',
        'text' => '商品',
        'hook'=>'hook_menu_after_product',
        'submenus' => [
                ['product/index', '所有商品', ['product/index', 'product/update'],'hook_submenu_after_product_index'],
                ['product/create', '新商品', ['product/create'],'hook_submenu_after_product_create'],
                ['category/index', '分类目录', ['category/index', 'category/update'],'hook_submenu_after_category_index'],
                ['guige/index', '规格', ['guige/index', 'guige/update'],'hook_submenu_after_guige_index'],
                ['pinpai/index', '品牌', ['pinpai/index', 'pinpai/update'],'hook_submenu_after_pinpai_index']
        ],
    ],
    'customer' => [
        'icon_class' => 'dashicons-admin-customer',
        'icon-font' => '\f110',
        'url' => 'customer/index',
        'text' => '用户',
        'hook'=>'hook_menu_after_customer',
        'submenus' => [
                ['customer/index', '所有用户', ['customer/index', 'customer/update'],'hook_submenu_after_customer_index'],
                ['customer/create', '新用户', ['customer/create'],'hook_submenu_after_customer_create'],
        ],
    ],
    'order' => [
        'icon_class' => 'dashicons-admin-order',
        'icon-font' => '\f157',
        'url' => 'order/index',
        'text' => '订单',
        'hook'=>'hook_menu_after_order',
        'submenus' => [
                ['order/index', '所有订单', ['order/index', 'order/update'],'hook_submenu_after_order_index'],
        ],
    ],
];



