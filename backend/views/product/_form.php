<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    $(function(){
        $('#category-btn').click(function(){
            $('.theme-overlay').show();
        });
        $('.close').click(function(){
                $('.theme-overlay').hide();
            });
    });
</script>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title',['labelOptions'=>['label'=>'标题']])->textInput(['maxlength' => true]) ?>
    
    

    <?= $form->field($model, 'price',['labelOptions'=>['label'=>'价格']])->textInput(["style"=>'width:100px']) ?>

    <p><span class="btn btn-info" id="category-btn">选择分类</span></p>
    
    <?= $form->field($model, 'detial',['labelOptions'=>['label'=>'详情']])->widget(\yii\redactor\widgets\Redactor::className(), [
    'clientOptions' => [
        'imageManagerJson' => ['/redactor/upload/image-json'],
        'imageUpload' => ['/redactor/upload/image'],
        'fileUpload' => ['/redactor/upload/file'],
        'lang' => 'zh_cn',
        'plugins' => ['clips', 'fontcolor','imagemanager']
    ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php include('../views/inc/layer.php'); ?>