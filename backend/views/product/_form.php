<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    $(function(){
        $('#category-btn').click(function(){
            $('.theme-overlay').show();
            var cid = $('input[name="Product[cid]"]').val();
            if(cid>0){
                console.log(cid);
                var id = '#cid-'+cid;
                $(id).prop('checked',true);
            }
        });
        $('#repeak').click(function(){
            $('.theme-overlay').show();
        });
        $('.close').click(function(){
                $('.theme-overlay').hide();
        });
    });
</script>
<style>
    #selected-category b{color:red}
</style>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <p>
        <span class="button button-primary" id="category-btn">选择分类</span>
        <span id="selected-category" style="display: none"><b></b>
            <a href="javascript:void(0)" class="button button-secondary" id="repeak">重新选择</a>
        </span>
        <?= $form->field($model, 'cid')->hiddenInput(['value'=> $model->isNewRecord?0:$model->cid])->label(false); ?>
    </p>
    
    <?= $form->field($model, 'title',['labelOptions'=>['label'=>'标题']])->textInput(['maxlength' => true]) ?>
    
    

    <?= $form->field($model, 'price',['labelOptions'=>['label'=>'价格']])->textInput(["style"=>'width:100px']) ?>

    
    
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
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'button button-primary' : 'button button-primary']) ?>
        <a href="<?=Url::toRoute(['/product/index'])?>" class="button button-secondary">返回</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php include('../views/inc/layer.php'); ?>