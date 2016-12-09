<?php

namespace backend\components;

use yii\base\Widget;

class MyGrid extends Widget {
    public $mes;
    public $dataProvider;
    public $params;
    public $template;

    public function init() {
        parent::init();
        if ($this->mes === null) {
            $this->mes = 'My Data Grid Widget';
        }
    }

    public function run() {
        return $this->render($this->template,[
                    'dataProvider'=> $this->dataProvider,
                    'params'=> $this->params
            ]);
    }

}
