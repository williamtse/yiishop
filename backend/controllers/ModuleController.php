<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class ModuleController extends Controller 
{
    /**
     * 安装模块
     */
    public function install()
    {
        //下载
//        $zip = Yii::$app->request->get('zip');
//        curl_download($zip, 'tmp.zip');
        //解压安装
        unzip('php_interbase.zip', APP_DIR.'modules');
        //
    }
    
    /**
     * 启用
     */
    public function active()
    {
        $module_name = Yii::$app->request->get('module');
        $modules_file = APP_DIR.'modules/module_map.txt';
        $modules = file_get_contents($modules_file);
        if($modules = json_decode($modules,true))
        {
            if(isset($modules[$module_name])){
                $modules[$module_name]['actived'] = 1;
            }
        }
    }
    
    /**
     * 禁用
     */
    public function unactive()
    {
        $module_name = Yii::$app->request->get('module');
        $modules_file = APP_DIR.'modules/module_map.txt';
        $modules = file_get_contents($modules_file);
        if($modules = json_decode($modules,true))
        {
            if(isset($modules[$module_name])){
                $modules[$module_name]['actived'] = 0;
            }
        }
    }
    
    /**
     * 卸载模块
     */
    public function uninstall()
    {
        
    }
}

