<?php
use yii\helpers\Url;
use common\models\Category;
$cates = Yii::$app->db->createCommand('SELECT * FROM category')
        ->queryAll();
$cate_tree = Category::toTree($cates);
?>
<script>
    $(function(){
        $("#select-category-ok").click(function(){
            var cid = $("input[name=cid]:checked").val();
            if(cid>0){
                var name = $("input[name=cid]:checked").attr('data-name');
                $(".theme-overlay").hide();
                $("#selected-category b").html(name);
                $("#product-cid").val(cid);
                $("#selected-category").show();
                $("#category-btn").hide();
            }else{
                alert("请选择商品目录");
            }
        }); 
        $("#select-category-cancel").click(function(){
            $(".theme-overlay").hide();
        });
    });
   
</script>
<div class="theme-overlay" style="display: none"><div class="theme-overlay active">
        <div class="theme-backdrop"></div>
        <div class="theme-wrap wp-clearfix">
            <div class="theme-header">
                <button class="close dashicons dashicons-no"><span class="screen-reader-text">关闭详情对话框</span></button>
            </div>
            <div class="theme-about wp-clearfix">
                <?php foreach($cate_tree as $top){ ?>
                <h3><?=$top['name']?></h3>
                <div>
                    <?php if(isset($top['sub'])){ ?>
                        <?php foreach($top['sub'] as $sub){?>
                    <span> <input data-name="<?=$sub['name']?>" id="cid-<?=$sub['id']?>" name="cid" value="<?=$sub['id']?>" type="radio"><label for="cid-<?=$sub['id']?>"><?=$sub['name']?></label> </span>
                        <?php }?>
                    <?php }?>
                </div>
                <?php } ?>
            </div>

            <div class="theme-actions">
                <div class="active-theme">
                    <a href="javascript:void(0)" class="button button-primary customize load-customize hide-if-no-customize" id="select-category-ok">确定</a>
                    <a href="<?=Url::toRoute(['category/index'])?>" class="button button-primary customize load-customize hide-if-no-customize">新建分类目录</a>
                    <a href="javascript:void(0)" class="button button-secondary customize load-customize hide-if-no-customize" id="select-category-cancel">取消</a>
                <div class="inactive-theme">

                    <a href="http://wordpress/wp-admin/themes.php?action=activate&amp;stylesheet=twentyfifteen&amp;_wpnonce=708193dcee" class="button button-secondary activate" aria-label="Activate Twenty Fifteen">取消</a>

                </div>


            </div>
        </div>
    </div></div>
