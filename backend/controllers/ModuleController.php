<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use backend\models\Module;

class ModuleController extends Controller {

    public function actionIndex() {
        global $module_infos;
        return $this->render('index', ['module_infos' => $module_infos]);
    }

    /**
     * 安装模块
     */
    public function actionInstall() {
        //远程获取所有可用功能模块
        $api = API_MODULE_LIST;
        $response = Yii::$app->curl->get($api);
        $arr = json_decode($response, true);
        return $this->render('install', [
                    'list' => $arr['list']
        ]);
    }

    public function actionInstall_module() {
        $package = Yii::$app->request->get('package');
        $full_name = Yii::$app->request->get('full_name');
        return $this->render('install_module', ['package' => $package, 'full_name' => $full_name]);
    }

    /**
     * 启用
     */
    public function actionActive() {
        $module_name = Yii::$app->request->get('name');
        $active_info = get_module_map();
        $active_info[$module_name] = 1;
        reset_module_map($active_info);
        return $this->redirect([strtolower($module_name).'/default']);
    }

    /**
     * 禁用
     */
    public function actionUnactive() {
        $module_name = Yii::$app->request->get('name');
        $active_info = get_module_map();
        if (isset($active_info[$module_name])) {
            $active_info[$module_name] = 0;
            reset_module_map($active_info);
        }
        return $this->redirect(['index']);
    }

    /**
     * 卸载模块
     */
    public function actionDelete() {
        $module_name = Yii::$app->request->get('name');
        deldir(APP_DIR.'modules/'.$module_name);
        $active_info = get_module_map();
        if (isset($active_info[ucwords($module_name)])) {
            unset($active_info[ucwords($module_name)]);
            reset_module_map($active_info);
        }
        return $this->redirect(['index']);
    }

    public function actionInstall_frame() {
        $package = Yii::$app->request->get('package');
        sendMessage('<h1>正在安装模块：' . Yii::$app->request->get('full_name') . '</h1>');
        sendMessage('<p>正在从<span class="code">' . API_PACKAGES . $package . '</span>下载安装包…</p>');
        Yii::$app->upgrader->get_remote_package($package);
        sendMessage("<p>正在解压<span class=\"code\">$package</span>…</p>" . "\n");
        Yii::$app->upgrader->unzip_package($package);
        sendMessage("<p>正在检查安装包...</p>");
        if(!Yii::$app->upgrader->check_package($package)){
            sendMessage("<p>".Yii::$app->upgrader->error."</p>");
            sendMessage("<p>安装失败</p>");
            deldir(Yii::$app->upgrader->install_path);
            exit();
        }
        sendMessage("<p>安装完毕</p>");
        sendMessage('<script>parent.document.location.href="'.Url::toRoute('module/index').'";</script>');
    }
}
