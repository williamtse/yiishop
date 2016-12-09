<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
$top_cates = array();
$categories = Category::find()->where(['pid'=>0])->all();
foreach($categories as $ca)
{
    $top_cates[$ca->id] = $ca->name;
}
?>
<div class="category-form">

    <?php $form = ActiveForm::begin([
    'action' => $model->isNewRecord ?['category/create']:['category/update','id'=>$model->id],
    'method'=>'post',
    ]); ?>

    <?= $form->field($model, 'name',['labelOptions'=>['label'=>'名称']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pid',['labelOptions'=>['label'=>'父节点']])->dropDownList($top_cates,['prompt'=>!$model->pid ?'请选择':$top_cates[$model->pid],'style'=>'width:120px']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加新分类目录' : '更新分类目录', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
