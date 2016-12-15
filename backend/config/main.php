<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

use backend\models\Module;
require 'apis.php';
define('APP_DIR',__DIR__.'/../');
global $menus,$module_infos;
require 'functions.php';

$modules = load_modules('../modules');
load_actived_modules('../modules');
$modules_info = get_module_map();

require 'website.php';

foreach($modules as $m=>$info)
{
    $upm = ucwords($m);
    if(isset($modules_info[$upm])){
        if($modules_info[$upm]===0){
            $modules_info[$m] = ['enable'=>false,'class'=>'backend\modules\\'.$m.'\\'. $upm];
        }else{
            $modules_info[$m] = 'backend\modules\\'.$m.'\\'. $upm;
        }
    }else{
        $modules_info[$m] = ['enable'=>false,'class'=>'backend\modules\\'.$m.'\\'. $upm];
    }
}
$modules_info['redactor'] = 'yii\redactor\RedactorModule';
require 'menu.php';

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => $modules_info,
    'components' => [
        'curl' => array(
            'class' => 'backend\helpers\Curl',
            'options' => array()
        ),
        'score'=>array(
          'class'=>'backend\helpers\Score',
        ),
        'upgrader'=>[
            'class'=>'backend\helpers\Upgrader'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ]
                ]
            ]
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    'params' => $params,
];
