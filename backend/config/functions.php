<?php

/**
 * 
 * @param type $module_dir
 * @return string
 */
function load_modules($module_dir) {
    $modules = array();
    if ($dh = opendir($module_dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..' && is_dir($module_dir.'/'.$file)) {
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
    foreach ($actions[$tag] as $func) {
        $params = explode(',', $args);
        call_user_func_array($func['function_to_add'], $params);
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

/**
 * 添加仪表盘菜单
 * @global array $menus
 * @param type $name
 * @param type $menu
 * @param type $dashicon icon 字体 如 f110 
 * https://developer.wordpress.org/resource/dashicons
 */
function add_menu($name, $menu, $dashicon) {
    global $menus;
    $menus[$name] = $menu;
    echo '<style>.dashicons-admin-user::before{content: "\\' . $dashicon . '";}</style>';
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

function unzip($zipfile,$toDir) {
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
