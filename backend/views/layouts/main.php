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
global $menus;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="wp-toolbar">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="wp-admin wp-core-ui js  index-php auto-fold admin-bar branch-4-6 version-4-6-1 admin-color-fresh locale-zh-cn customize-support svg sticky-menu">
        <?php $this->beginBody() ?>
        <script>
            $(function () {
                $('.wp-not-current-submenu').hover(function () {
                    $(this).addClass('opensub');
                    $(this).find('.wp-submenu').show();
                    $(this).find('.wp-submenu').css({'top': 0, 'display': 'block'});
                }, function () {
                    $(this).removeClass('opensub');
                    $(this).find('.wp-submenu').hide();
                });

            });
        </script>
        <style>
            <?php foreach($menus as $k=>$v){ ?>
            .<?=$v['icon_class']?>:before{
                content:'<?=$v['icon-font']?>';

            }
            <?php }?>
            <?= do_action('hook_style')?>
            .wp-submenu{
                top:0px;
            }
        </style>
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
                        <?php
                        foreach ($menus as $menu) {
                            $ctrls = [];
                            foreach ($menu['submenus'] as $m) {
                                $ctrls[] = substr($m[0], 0, strpos($m[0], '/'));
                            }
                            ?>
                            <li class="wp-has-submenu <?= (in_array($CTR_ID, $ctrls)) ? 'wp-has-current-submenu wp-menu-open' : 'wp-not-current-submenu' ?>  menu-top menu-icon-media" id="menu-posts">
                                <a href="<?= Url::toRoute($menu['url']) ?>" class="wp-has-submenu <?= (in_array($CTR_ID, $ctrls)) ? 'wp-has-current-submenu' : '' ?> wp-menu-open menu-top menu-icon-post open-if-no-js menu-top-first" aria-haspopup="false">
                                    <div class="wp-menu-arrow"><div></div></div>
                                    <div class="wp-menu-image dashicons-before <?= $menu['icon_class'] ?>"><br></div>
                                    <div class="wp-menu-name"><?= $menu['text'] ?></div>
                                </a>

                                <ul class="wp-submenu wp-submenu-wrap" <?= (in_array($CTR_ID, $ctrls)) ? '' : 'style="display:none"' ?>>
                                    <li class="wp-submenu-head" aria-hidden="true"><?= $menu['text'] ?></li>
    <?php foreach ($menu['submenus'] as $sub) { ?>
                                        <li class="wp-first-item <?= (in_array($CTR_ID . '/' . $ACT_ID, $sub[2]) ? 'current' : '') ?>">
                                            <a href="<?= Url::toRoute($sub[0]) ?>" class="wp-first-item <?= (in_array($CTR_ID . '/' . $ACT_ID, $sub[2]) ? 'current' : '') ?>"><?= $sub[1] ?></a>
                                        </li>
                            <?php
                                if(isset($sub['hook'])){
                                    do_action($sub['hook']);
                                }
                            ?>
    <?php } ?>
                                </ul>
                            </li>
                            <?php
                                if(isset($menu['hook'])){
                                    do_action($menu['hook']);

                                }
                            ?>

                                <?php } ?>
                    </ul>
                </div>
            </div>
            <div id="wpcontent">

                <div id="wpadminbar" class="">
                    <div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="工具栏" tabindex="0">
                        <ul id="wp-admin-bar-root-default" class="ab-top-menu">
                            <li id="wp-admin-bar-menu-toggle">
                                <a class="ab-item" href="<?= Url::toRoute('product/create') ?>" aria-expanded="false"><span class="ab-icon"></span><span class="screen-reader-text">菜单</span></a>		
                            </li>
                            <li id="wp-admin-bar-wp-logo" class="menupop">
                                <a class="ab-item" aria-haspopup="true" href="http://wordpress/wp-admin/about.php">
                                    <span class="ab-icon"></span>
                                    <span class="screen-reader-text">关于WordPress</span>
                                </a>
                                <div class="ab-sub-wrapper">
                                    <ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
                                        <li id="wp-admin-bar-about"><a class="ab-item" href="http://wordpress/wp-admin/about.php">关于WordPress</a>		</li>
                                    </ul>
                                    <ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
                                        <li id="wp-admin-bar-wporg"><a class="ab-item" href="https://cn.wordpress.org/">WordPress.org</a>		</li>
                                        <li id="wp-admin-bar-documentation"><a class="ab-item" href="https://codex.wordpress.org/">文档</a>		</li>
                                        <li id="wp-admin-bar-support-forums"><a class="ab-item" href="http://zh-cn.forums.wordpress.org/">支持论坛</a>		</li>
                                        <li id="wp-admin-bar-feedback"><a class="ab-item" href="http://zh-cn.forums.wordpress.org/forum/suggestions">反馈</a>		</li>
                                    </ul>
                                </div>		
                            </li>
                            <li id="wp-admin-bar-site-name" class="menupop"><a class="ab-item" aria-haspopup="true" href="http://wordpress/">cms</a>
                                <div class="ab-sub-wrapper">
                                    <ul id="wp-admin-bar-site-name-default" class="ab-submenu">
                                        <li id="wp-admin-bar-view-site"><a class="ab-item" href="http://wordpress/">查看站点</a>		
                                        </li>
                                    </ul>
                                </div>		
                            </li>
                            <li id="wp-admin-bar-comments"><a class="ab-item" href="http://wordpress/wp-admin/edit-comments.php"><span class="ab-icon"></span><span id="ab-awaiting-mod" class="ab-label awaiting-mod pending-count count-0" aria-hidden="true">0</span><span class="screen-reader-text">0条评论待审</span></a>		</li>
                            <li id="wp-admin-bar-new-content" class="menupop">
                                <a class="ab-item" aria-haspopup="true" href="http://wordpress/wp-admin/post-new.php">
                                    <span class="ab-icon"></span>
                                    <span class="ab-label">新建</span>
                                </a>
                                <div class="ab-sub-wrapper">
                                    <ul id="wp-admin-bar-new-content-default" class="ab-submenu">
                                        <li id="wp-admin-bar-new-post"><a class="ab-item" href="<?=Url::toRoute('product/create')?>">商品</a>		</li>
                                        <li id="wp-admin-bar-new-media"><a class="ab-item" href="http://wordpress/wp-admin/media-new.php"></a>		</li>
                                        <li id="wp-admin-bar-new-page"><a class="ab-item" href="http://wordpress/wp-admin/post-new.php?post_type=page">页面</a>		</li>
                                        <li id="wp-admin-bar-new-user"><a class="ab-item" href="http://wordpress/wp-admin/user-new.php">用户</a>		</li>
                                    </ul>
                                </div>		
                            </li>

                        </ul>
                        <ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
                            <li id="wp-admin-bar-my-account" class="menupop with-avatar">
                                <a class="ab-item" aria-haspopup="true" href="http://wordpress/wp-admin/profile.php">您好，root</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class="ab-submenu">
                                        <li id="wp-admin-bar-edit-profile"><a class="ab-item" href="http://wordpress/wp-admin/profile.php">编辑我的个人资料</a>		</li>
                                        <li id="wp-admin-bar-logout"><a class="ab-item" href="http://wordpress/wp-login.php?action=logout&amp;_wpnonce=922c1588bf">登出</a>		</li></ul></div>		</li></ul>			</div>
                    <a class="screen-reader-shortcut" href="http://wordpress/wp-login.php?action=logout&amp;_wpnonce=922c1588bf">登出</a>
                </div>


                <div id="wpbody" role="main">
                    <div id="wpbody-content">
                        <div class="wrap"><?= $content ?></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <!-- wpbody -->
                <div class="clear"></div>
            </div><!-- wpcontent -->


            <div id="wp-auth-check-wrap" class="hidden">
                <div id="wp-auth-check-bg"></div>
                <div id="wp-auth-check">
                    <button type="button" class="wp-auth-check-close button-link"><span class="screen-reader-text">关闭对话框</span></button>
                    <div id="wp-auth-check-form" class="loading" data-src="http://wordpress/wp-login.php?interim-login=1"></div>
                    <div class="wp-auth-fallback">
                        <p><b class="wp-auth-fallback-expired" tabindex="0">会话已过期</b></p>
                        <p><a href="http://wordpress/wp-login.php" target="_blank">请重新登录。</a>
                            登录页会在新窗口中打开，在登录后您可关闭该窗口并返回本页。</p>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="http://wordpress/wp-admin/load-styles.php?c=1&amp;dir=ltr&amp;load%5B%5D=wp-pointer&amp;ver=4.6.1" type="text/css" media="all">
            <link rel="stylesheet" id="aiosp_admin_style-css" href="http://wordpress/wp-content/plugins/all-in-one-seo-pack/css/aiosp_admin.css?ver=4.6.1" type="text/css" media="all">
            <div class="clear"></div>
                
        </div>


<?php $this->endBody() ?>
    </body>

</html>
        <?php $this->endPage() ?>
