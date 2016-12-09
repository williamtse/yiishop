<?php

use yii\helpers\Html;
use backend\components\MyGrid;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = '新建分类目录';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <form class="search-form wp-clearfix" method="get">
        <input type="hidden" name="taxonomy" value="category">
        <input type="hidden" name="post_type" value="post">

        <p class="search-box">
            <label class="screen-reader-text" for="tag-search-input">搜索分类目录:</label>
            <input type="search" id="tag-search-input" name="s" value="">
            <input type="submit" id="search-submit" class="button" value="搜索分类目录"></p>

    </form>

    <div id="col-container" class="wp-clearfix">
        <div id="col-left">
            <div class="col-wrap">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
        <div id="col-right">
            <div class="col-wrap">
                <?=
                MyGrid::widget([
                    'dataProvider' => $dataProvider,
                    'template'=>'category',
                    'params'=>[
                        'firstColumn'=>'name',
                        'orderby'=>Yii::$app->request->get('orderby'),
                        'order'=>Yii::$app->request->get('order')
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>



</div>
