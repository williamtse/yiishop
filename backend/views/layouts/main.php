<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;


AppAsset::register($this);
$CTR_ID = Yii::$app->controller->id;
$ACT_ID = Yii::$app->controller->action->id;


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  lang="zh-CN">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/xhtml" class="wp-toolbar">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="wp-admin wp-core-ui js  update-php admin-bar branch-4-5 version-4-5-4 admin-color-fresh locale-zh-cn customize-support sticky-menu svg">
        <?php $this->beginBody() ?>
        <script>
        var opensub = function(){
                $(this).addClass('opensub');
                $(this).find('.wp-submenu').show();
            };
        var closesub = function(){
                $(this).removeClass('opensub');
                $(this).find('.wp-submenu').hide();
            };
        var current_click_menu;
        $(function(){
            $('.wp-not-current-submenu').hover(opensub,closesub);
            $("#collapse-menu").click(function(){
                if($('body').hasClass('auto-fold')){
                    $('body').removeClass('auto-fold');
                }else{
                    $('body').addClass('auto-fold');
                }
            });
            $("#wp-admin-bar-menu-toggle").click(function(){
                $("#adminmenuback").toggle();
                $("#adminmenuwrap").toggle();
            });
        });
        </script>
            <?php
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
            }
            ?>

            <div id="wpwrap">
                <div id="adminmenumain" role="navigation" aria-label="主页">
                    <a href="#wpbody-content" class="screen-reader-shortcut">跳至主内容</a>
                    <a href="#wp-toolbar" class="screen-reader-shortcut">跳至工具栏</a>
                    <div id="adminmenuback"></div>
                    <div id="adminmenuwrap">
                        <ul id="adminmenu">
                            <li class="wp-first-item wp-has-submenu wp-not-current-submenu menu-top menu-top-first menu-icon-dashboard menu-top-last" id="menu-dashboard">
                                <a href="index.php" class="wp-first-item wp-has-submenu wp-not-current-submenu menu-top menu-top-first menu-icon-dashboard menu-top-last" aria-haspopup="true">
                                    <div class="wp-menu-arrow">
                                        <div>

                                        </div>

                                    </div>
                                    <div class="wp-menu-image dashicons-before dashicons-dashboard"><br></div>
                                    <div class="wp-menu-name">仪表盘</div>
                                </a>
                                <ul class="wp-submenu wp-submenu-wrap"><li class="wp-submenu-head" aria-hidden="true">仪表盘</li>
                                    <li class="wp-first-item"><a href="index.php" class="wp-first-item">首页</a></li>
                                    <li><a href="update-core.php">更新<span class="update-plugins count-4" title="1个WordPress更新, 1个插件更新, 2个主题更新"><span class="update-count">4</span></span></a></li>
                                </ul>
                            </li>
                            <style>
                                .dashicons-admin-product:before{
                                    content:'\f174';
                                }
                                .dashicons-admin-module:before{
                                    content:'\f180';
                                }
                                .wp-submenu{
                                    top:0px;
                                }
                            </style>
                            <?php 
                                global $menus;
                                do_action('hook_get_menus');
                            ?>
                            <?php foreach($menus as $menu){ 
                                        $ctrls = [];
                                        foreach($menu['submenus'] as $m)
                                        {
                                            $ctrls[] = substr($m[0],0, strpos($m[0],'/'));
                                        }
                            ?>
                            <li class="wp-has-submenu <?=(in_array($CTR_ID, $ctrls))?'wp-has-current-submenu wp-menu-open':'wp-not-current-submenu'?>  menu-top menu-icon-media" id="menu-posts">
                                <a href="<?=Url::toRoute($CTR_ID.'/'.$ACT_ID)?>" class="wp-has-submenu <?=(in_array($CTR_ID, $ctrls))?'wp-has-current-submenu':''?> wp-menu-open menu-top menu-icon-post" aria-haspopup="false">
                                    <div class="wp-menu-arrow"><div></div></div>
                                    <div class="wp-menu-image dashicons-before <?=$menu['icon_class']?>"><br></div>
                                    <div class="wp-menu-name"><?=$menu['text']?></div>
                                </a>
                                
                                <ul class="wp-submenu wp-submenu-wrap" <?=(in_array($CTR_ID, $ctrls))?'':'style="display:none"'?>>
                                    <li class="wp-submenu-head" aria-hidden="true"><?=$menu['text']?></li>
                                    <?php foreach($menu['submenus'] as $sub){?>
                                    <li class="<?=(in_array($CTR_ID.'/'.$ACT_ID,$sub[2])?'current':'')?>">
                                        <a href="<?= Url::toRoute($sub[0]) ?>" class="<?=(in_array($CTR_ID.'/'.$ACT_ID,$sub[2])?'current':'')?>"><?=$sub[1]?></a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </li>
                            <?php }?>
                            <li id="collapse-menu" class="hide-if-no-js"><div id="collapse-button"><div></div></div><span>收起菜单</span></li>
                        </ul>
                    </div>
                </div>
                <div id="wpcontent">

                    <div id="wpadminbar" class="">
                        <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="工具栏" tabindex="0">
                            <ul id="wp-admin-bar-root-default" class="ab-top-menu">
                                <li id="wp-admin-bar-menu-toggle"><a class="ab-item" href="#" aria-expanded="false"><span class="ab-icon"></span><span class="screen-reader-text">菜单</span></a>		</li>
                                <li id="wp-admin-bar-wp-logo" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://wordpress/wp-admin/about.php"><span class="ab-icon"></span><span class="screen-reader-text">关于WordPress</span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
                                            <li id="wp-admin-bar-about"><a class="ab-item" href="http://wordpress/wp-admin/about.php">关于WordPress</a>		</li></ul><ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
                                            <li id="wp-admin-bar-wporg"><a class="ab-item" href="https://cn.wordpress.org/">WordPress.org</a>		</li>
                                            <li id="wp-admin-bar-documentation"><a class="ab-item" href="https://codex.wordpress.org/">文档</a>		</li>
                                            <li id="wp-admin-bar-support-forums"><a class="ab-item" href="http://zh-cn.forums.wordpress.org/">支持论坛</a>		</li>
                                            <li id="wp-admin-bar-feedback"><a class="ab-item" href="http://zh-cn.forums.wordpress.org/forum/suggestions">反馈</a>		</li></ul></div>		</li>
                                <li id="wp-admin-bar-site-name" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://wordpress/">cms</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-site-name-default" class="ab-submenu">
                                            <li id="wp-admin-bar-view-site"><a class="ab-item" href="http://wordpress/">查看站点</a>		</li></ul></div>		</li>
                                <li id="wp-admin-bar-comments"><a class="ab-item" href="http://wordpress/wp-admin/edit-comments.php"><span class="ab-icon"></span><span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-0" aria-hidden="true">0</span><span class="screen-reader-text">0条评论待审</span></a>		</li>
                                <li id="wp-admin-bar-new-content" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://wordpress/wp-admin/post-new.php"><span class="ab-icon"></span><span class="ab-label">新建</span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-new-content-default" class="ab-submenu">
                                            <li id="wp-admin-bar-new-post"><a class="ab-item" href="http://wordpress/wp-admin/post-new.php">文章</a>		</li>
                                            <li id="wp-admin-bar-new-media"><a class="ab-item" href="http://wordpress/wp-admin/media-new.php">媒体</a>		</li>
                                            <li id="wp-admin-bar-new-page"><a class="ab-item" href="http://wordpress/wp-admin/post-new.php?post_type=page">页面</a>		</li>
                                            <li id="wp-admin-bar-new-user"><a class="ab-item" href="http://wordpress/wp-admin/user-new.php">用户</a>		</li></ul></div>		</li>
                                <li id="wp-admin-bar-all-in-one-seo-pack" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://wordpress/wp-admin/admin.php?page=all-in-one-seo-pack/aioseop_class.php">搜索引擎优化</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-all-in-one-seo-pack-default" class="ab-submenu">
                                            <li id="wp-admin-bar-aioseop-pro-upgrade"><a class="ab-item" href="https://semperplugins.com/plugins/all-in-one-seo-pack-pro-version/?loc=menu" target="_blank">升级到专业版</a>		</li>
                                            <li id="wp-admin-bar-all-in-one-seo-pack/modules/aioseop_performance.php"><a class="ab-item" href="http://wordpress/wp-admin/admin.php?page=all-in-one-seo-pack/modules/aioseop_performance.php">性能</a>		</li>
                                            <li id="wp-admin-bar-all-in-one-seo-pack/modules/aioseop_sitemap.php"><a class="ab-item" href="http://wordpress/wp-admin/admin.php?page=all-in-one-seo-pack/modules/aioseop_sitemap.php">XML网站地图</a>		</li>
                                            <li id="wp-admin-bar-all-in-one-seo-pack/modules/aioseop_file_editor.php"><a class="ab-item" href="http://wordpress/wp-admin/admin.php?page=all-in-one-seo-pack/modules/aioseop_file_editor.php">文件编辑器</a>		</li>
                                            <li id="wp-admin-bar-all-in-one-seo-pack/modules/aioseop_feature_manager.php"><a class="ab-item" href="http://wordpress/wp-admin/admin.php?page=all-in-one-seo-pack/modules/aioseop_feature_manager.php">功能管理</a>		</li></ul></div>		</li></ul><ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
                                <li id="wp-admin-bar-my-account" class="menupop with-avatar">
                                    <a class="ab-item" aria-haspopup="true" href="http://wordpress/wp-admin/profile.php">您好，root</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class="ab-submenu">
                                            <li id="wp-admin-bar-edit-profile"><a class="ab-item" href="http://wordpress/wp-admin/profile.php">编辑我的个人资料</a>		</li>
                                            <li id="wp-admin-bar-logout"><a class="ab-item" href="http://wordpress/wp-login.php?action=logout&amp;_wpnonce=922c1588bf">登出</a>		</li></ul></div>		</li></ul>			</div>
                        <a class="screen-reader-shortcut" href="http://wordpress/wp-login.php?action=logout&amp;_wpnonce=922c1588bf">登出</a>
                    </div>


                    <div id="wpbody" role="main">
                        <div id="wpbody-content" tabindex="0">
                            <?= $content ?>
                        </div>
                        <div class="clear"></div>
                    </div><!-- wpbody -->
                    <div class="clear"></div>
                </div>
                <!-- wpcontent -->
                <div class="clear"></div>
            </div>
            <?php $this->endBody() ?>
        </body>
</html>
<?php $this->endPage() ?>
