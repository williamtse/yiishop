<?php

function add_user_menu()
{
    global $menus;
    $menu = ['icon_class'=>'dashicons-admin-user','url'=>'user/index','text'=>'用户','submenus'=>[
        ['user/index','所有用户',['user/index','user/update']],
        ['user/create','新用户',['user/create']],
    ]];
    add_menu('User', $menu,'f110');
    
}
add_action('hook_get_menus','add_user_menu');

