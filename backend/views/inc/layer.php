<?php
use yii\helpers\Url;
use common\models\Category;
$cates = Yii::$app->db->createCommand('SELECT * FROM category')
        ->queryAll();
$cate_tree = Category::toTree($cates);
?>

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
                    <span> <input id="cid-<?=$sub['id']?>" name="cid" value="<?=$sub['id']?>" type="radio"><label for="cid-<?=$sub['id']?>"><?=$sub['name']?></label> </span>
                        <?php }?>
                    <?php }?>
                </div>
                <?php } ?>
            </div>

            <div class="theme-actions">
                <div class="active-theme">
                    <a href="" class="button button-primary customize load-customize hide-if-no-customize">确定</a>
                    <a href="<?=Url::toRoute(['category/index'])?>" class="button button-primary customize load-customize hide-if-no-customize">新建分类目录</a>
                <div class="inactive-theme">

                    <a href="http://wordpress/wp-admin/themes.php?action=activate&amp;stylesheet=twentyfifteen&amp;_wpnonce=708193dcee" class="button button-secondary activate" aria-label="Activate Twenty Fifteen">取消</a>

                </div>


            </div>
        </div>
    </div></div>
