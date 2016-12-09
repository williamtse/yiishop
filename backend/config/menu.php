<?php

global $menus;

$menus = [
    'Product'=>['icon_class'=>'dashicons-admin-product','url'=>'product/index','text'=>'商品','is_first_item'=>1,'submenus'=>[
        ['product/index','所有商品',['product/index','product/update']],
        ['product/create','新商品',['product/create']],
        ['category/index','分类目录',['category/index','category/update']],
        ['guige/index','规格',['guige/index','guige/update']],
        ['pinpai/index','品牌',['pinpai/index','pinpai/update']]
    ]],
];


