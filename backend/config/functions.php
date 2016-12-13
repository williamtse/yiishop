<?php

use yii\helpers\Url;

/**
 * 
 * @param type $module_dir
 * @return string
 */
function load_modules($module_dir) {
    global $module_infos;

    $modules = array();
    if ($dh = opendir($module_dir)) {
        while (($file = readdir($dh)) !== false) {
            $module_folder = $module_dir . '/' . $file;
            if ($file != '.' && $file != '..' && is_dir($module_folder)) {
                $main_file = ucfirst($file);
                $modules[$file] = 'backend\modules\\' . $file . '\\' . $main_file;
                $module_infos[$file] = get_file_data($module_folder . '/' . $main_file . '.php');
            }
        } closedir($dh);
    }
    $active_info = get_module_map();
    if (!empty($active_info)) {
        foreach ($active_info as $m => $a) {
            $module_infos[strtolower($m)]['actived'] = $a;
        }
    }
    return $modules;
}

function load_actived_modules($module_dir) {
    $active_info = get_module_map();
    if (!empty($active_info)) {
        foreach ($active_info as $m => $a) {
            if($a){
                include_once $module_dir . '/' . $m . '/config.php';
            }
        }
    }
    return true;
}

function get_module_map() {
    if ($module_map = file_get_contents(APP_DIR . 'modules/module_map.txt')) {
        if ($active_info = json_decode($module_map, true)) {
            return $active_info;
        }
    }
    return array();
}

function reset_module_map($mapinfo) {
    file_put_contents(APP_DIR . 'modules/module_map.txt', json_encode($mapinfo));
}

function _cleanup_header_comment($str) {
    return trim(preg_replace("/\s*(?:\*\/|\?>).*/", '', $str));
}

function deldir($dir) {
    //先删除目录下的文件：
    if (!is_dir($dir))
        return true;
    $dh=opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }

    closedir($dh);
    //删除当前文件夹：
    if (rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}

function get_file_data($file, $context = '') {
    $default_headers = array(
        'Name' => 'Plugin Name',
        'PluginURI' => 'Plugin URI',
        'Version' => 'Version',
        'Description' => 'Description',
        'Author' => 'Author',
        'AuthorURI' => 'Author URI',
        'TextDomain' => 'Text Domain',
        'DomainPath' => 'Domain Path',
        'Network' => 'Network',
        // Site Wide Only is deprecated in favor of Network.
        '_sitewide' => 'Site Wide Only',
    );
    // We don't need to write to the file, so just open for reading.
    $fp = fopen($file, 'r');

    // Pull only the first 8kiB of the file in.
    $file_data = fread($fp, 8192);

    // PHP will close file handle, but we are good citizens.
    fclose($fp);

    // Make sure we catch CR-only line endings.
    $file_data = str_replace("\r", "\n", $file_data);

    /**
     * Filter extra file headers by context.
     *
     * The dynamic portion of the hook name, `$context`, refers to
     * the context where extra headers might be loaded.
     *
     * @since 2.9.0
     *
     * @param array $extra_context_headers Empty array by default.
     */
    if ($context && $extra_headers = apply_filters("extra_{$context}_headers", array())) {
        $extra_headers = array_combine($extra_headers, $extra_headers); // keys equal values
        $all_headers = array_merge($extra_headers, (array) $default_headers);
    } else {
        $all_headers = $default_headers;
    }

    foreach ($all_headers as $field => $regex) {
        if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $file_data, $match) && $match[1])
            $all_headers[$field] = _cleanup_header_comment($match[1]);
        else
            $all_headers[$field] = '';
        $all_headers['actived'] = 0;
    }

    return $all_headers;
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
    if (isset($actions[$tag])) {

        if (!empty($actions[$tag])) {
            foreach ($actions[$tag] as $func) {
                $params = explode(',', $args);
                call_user_func_array($func['function_to_add'], $params);
            }
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
        $uri = substr($m[0], 1);
        $uri_arr = explode('/', $uri);
        $ctrls[] = $uri_arr[1];
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

/**
 * Flush all output buffers for PHP 5.2.
 *
 * Make sure all output buffers are flushed before our singletons are destroyed.
 *
 * @since 2.2.0
 */
function wp_ob_end_flush_all() {
    $levels = ob_get_level();
    for ($i = 0; $i < $levels; $i++)
        ob_end_flush();
}

function sendMessage($msg) {
    echo $msg;
    ob_flush();
    flush();
}

function module_has_installed($module_name, $module_infos) {
    return isset($module_infos[strtolower($module_name)]);
}
