<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\components\MyGrid;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="wrap">
        <h1>商品 <a href="<?=Url::toRoute(['product/create'])?>" class="page-title-action">新建商品</a></h1>


        <h2 class="screen-reader-text">过滤商品列表</h2><ul class="subsubsub">
            <li class="all"><a href="<?=Url::toRoute(['product/index'])?>" class="current">全部<span class="count">（1）</span></a> |</li>
            <li class="publish"><a href="<?=Url::toRoute(['product/index','status'=>'publish'])?>">已发布<span class="count">（1）</span></a> |</li>
            <li class="trash"><a href="<?=Url::toRoute(['product/index','status'=>'trash'])?>">回收站<span class="count">（1）</span></a></li>
        </ul>    
        <?=
        MyGrid::widget([
            'dataProvider' => $dataProvider,
            'template' => 'product',
            'params' => [],
        ]);
        ?>
    </div>
</div>
