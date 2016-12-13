<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function add_test_menu()
{
    $menu = [
        'icon_class' => 'dashicons-admin-test',
        'icon-font' => '\f468',
        'url' => '/test/default',
        'text' => '测试',
        'submenus' => [
                ['/test/default/index', '所有测试', ['default/index']],
                ['/test/default/hello','hello',['default/hello']]
        ],
    ];
    echo get_menu_html($menu);
}

function add_menu_icon()
{
    echo ".dashicons-admin-test:before{content:'\\f486'}";
}

add_action('hook_menu_after_site', 'add_test_menu');
add_action('hook_style','add_menu_icon');