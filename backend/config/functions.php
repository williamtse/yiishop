<?php

use yii\helpers\Url;


/**
 * 
 * @param type $module_dir
 * @return string
 */
function load_modules($module_dir) {
    $modules = array();
    if ($dh = opendir($module_dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..' && is_dir($module_dir . '/' . $file)) {
                $modules[$file] = 'app\modules\\' . $file . '\\' . ucfirst($file);

                include_once $module_dir . '/' . $file . '/config.php';
            }
        } closedir($dh);
    }
    return $modules;
}

/**
 * 
 * @param type $tag
 * @param type $function_to_add
 * @param type $priority
 * @param type $accepted_args
 * @return boolean
 */
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
    global $actions, $filters;
    if (!isset($actions[$tag]))
        $actions[$tag] = [];
    $actions[$tag][] = [
        'function_to_add' => $function_to_add,
        'priority' => $priority,
        'accepted_args' => $accepted_args
    ];
    return true;
}

/**
 * 
 * @global type $actions
 * @param type $tag
 * @param type $args
 */
function do_action($tag, $args = '') {
    global $actions;
    if(isset($actions[$tag])){
        foreach ($actions[$tag] as $func) {
            $params = explode(',', $args);
            call_user_func_array($func['function_to_add'], $params);
        }
    }
}

/**
 * 获取仪表盘菜单钩子
 * @global array $menus
 * @return type
 */
function hook_get_menus() {
    global $menus;
    return $menus;
}

function hook_menu_after_dashboard() {
    
}

/**
 * 获取菜单html
 * @param type $name
 * @param type $menu
 * https://developer.wordpress.org/resource/dashicons
 */
function get_menu_html($menu) {
    $CTR_ID = Yii::$app->controller->id;
    $ACT_ID = Yii::$app->controller->action->id;
    foreach ($menu['submenus'] as $m) {
        $ctrls[] = substr($m[0], 0, strpos($m[0], '/'));
    }
    $menu_html = '<li class="wp-has-submenu ' . ((in_array($CTR_ID, $ctrls)) ? 'wp-has-current-submenu wp-menu-open' : 'wp-not-current-submenu') . '  menu-top menu-icon-media" id="menu-posts">
                                <a href="' . Url::toRoute($menu['url']) . '" class="wp-has-submenu ' . ((in_array($CTR_ID, $ctrls)) ? 'wp-has-current-submenu' : '') . ' wp-menu-open menu-top menu-icon-post open-if-no-js menu-top-first" aria-haspopup="false">
                                    <div class="wp-menu-arrow"><div></div></div>
                                    <div class="wp-menu-image dashicons-before ' . $menu['icon_class'] . '"><br></div>
                                    <div class="wp-menu-name">' . $menu['text'] . '</div>
                                </a>

                                <ul class="wp-submenu wp-submenu-wrap" ' . ((in_array($CTR_ID, $ctrls)) ? '' : 'style="display:none"') . '>
                                    <li class="wp-submenu-head" aria-hidden="true">' . $menu['text'] . '</li>';
    foreach ($menu['submenus'] as $sub) {
        $menu_html .= '<li class="wp-first-item ' . (in_array($CTR_ID . '/' . $ACT_ID, $sub[2]) ? 'current' : '') . '">
                                            <a href="' . Url::toRoute($sub[0]) . '" class="wp-first-item ' . (in_array($CTR_ID . '/' . $ACT_ID, $sub[2]) ? 'current' : '') . '">' . $sub[1] . '</a>
                                        </li>';
    }
    $menu_html .= '</ul>
                            </li>';
    return $menu_html;
}

function curl_download($url, $dir) {
    $ch = curl_init($url);
    $fp = fopen($dir, "wb");
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $res = curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    return $res;
}

function unzip($zipfile, $toDir) {
    $zip = new \ZipArchive;
    $res = $zip->open($zipfile);
    if (!file_exists($toDir)) {
        mkdir($toDir);
    }
    $docnum = $zip->numFiles;
    for ($i = 0; $i < $docnum; $i++) {
        $statInfo = $zip->statIndex($i);
        if ($statInfo['crc'] == 0) {
            //新建目录
            mkdir($toDir . '/' . substr($statInfo['name'], 0, -1));
        } else {
            //拷贝文件
            copy('zip://' . $zipfile . '#' . $statInfo['name'], $toDir . '/' . $statInfo['name']);
        }
    }
}
