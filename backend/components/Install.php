<?php

namespace backend\components;

use Yii;
use yii\base\Widget;

class Install extends Widget {

    public $action;
    public $full_name;
    public $package;

    public function init() {
        parent::init();
    }

    public function run() {
        if ($this->action == 'install_module') {
            
            
        }
    }

}
