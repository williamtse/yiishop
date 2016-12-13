<?php

use yii\helpers\Url;

global $module_infos;
?>
<h1>
    添加模块 <a href="<?= Url::toRoute(["module/upload"]) ?>" class="upload page-title-action">上传模块</a>
</h1>

<h2 class="screen-reader-text">过滤模块列表</h2>

<div class="wp-filter">
    <ul class="filter-links">
        <li class="plugin-install-featured"><a href="<?= Url::toRoute(["module/install", "tab" => "featured"]) ?>" class=" current">特色</a> </li>
        <li class="plugin-install-popular"><a href="<?= Url::toRoute(["module/install", "tab" => "popular"]) ?>" class="">热门</a> </li>
        <li class="plugin-install-recommended"><a href="<?= Url::toRoute(["module/install", "tab" => "recommended"]) ?>" class="">推荐</a> </li>
        <li class="plugin-install-favorites"><a href="<?= Url::toRoute(["module/install", "tab" => "favorites"]) ?>" class="">收藏</a></li>
    </ul>

    <form class="search-form search-plugins" method="get">
        <input type="hidden" name="tab" value="search">
        <label><span class="screen-reader-text">搜索模块</span>
            <input type="search" name="s" value="" class="wp-filter-search" placeholder="搜索模块">
        </label>
        <input type="submit" id="search-submit" class="button screen-reader-text" value="搜索模块">	
    </form>
</div>

<br class="clear">

<form id="plugin-filter" method="post">
    <div class="wp-list-table widefat plugin-install">
        <div id="the-list">
<?php if (!empty($list)) { ?>
    <?php foreach ($list as $l) { ?>
                    <div class="plugin-card plugin-card-wp-super-cache">
                        <div class="plugin-card-top">
                            <div class="name column-name">
                                <h3>
                                    <a href="" class="thickbox open-plugin-details-modal">
        <?= $l["name"] ?>	
                                        <img src="<?= $l['logo'] ?>" class="plugin-icon" alt="">
                                    </a>
                                </h3>
                            </div>
                            <div class="action-links">
                                <ul class="plugin-action-buttons">
                                    <li>
        <?php if (module_has_installed($l['name'], $module_infos)) { ?>
                           <a class="install-now button" data-slug="wp-super-cache" 
                                    href="javascript:void(0)" aria-label="已安装<?= $l['name'] . $l['version'] ?>" 
                                    data-name="<?=$l['full_name']?>">
                               已安装
                                                </a>             
        <?php } else { ?>
                            <a class="install-now button" data-slug="wp-super-cache" 
                                href="<?= Url::toRoute(['module/install_module', 'package' => $l['package'], 'full_name' => $l['full_name']]) ?>" aria-label="现在安装<?= $l['name'] . $l['version'] ?>" data-name="WP Super Cache 1.4.8">
                                 现在安装</a>
        <?php } ?>
                                    </li>
                                    <li>
                                        <a href="<?= Url::toRoute(['module/infomation', 'package' => $l['package']]) ?>" 
                                           class="thickbox open-plugin-details-modal" 
                                           aria-label="关于的更多信息" 
                                           data-title="<?= $l['full_name'] ?>">更多详情</a></li></ul>				
                            </div>
                            <div class="desc column-description">
                                <p>
        <?= $l["description"] ?>
                                </p>
                                <p class="authors"> <cite>由<a href="<?= $l['author_url'] ?>"><?= $l['author'] ?></a>创建</cite></p>
                            </div>
                        </div>
                        <div class="plugin-card-bottom">
                            <div class="vers column-rating">
                                <div class="star-rating">
                                    <span class="screen-reader-text"><?= $l["score"] ?>分（基于<?= $l["score"] ?>次评分）</span>
        <?= Yii::$app->score->show($l['score']) ?>
                                </div>					
                                <span class="num-ratings" aria-hidden="true">(<?= $l['score_count'] ?>)</span>
                            </div>
                            <div class="column-updated">
                                <strong>最近更新：<?= $l['upgrade_time'] ?></strong> 
                            </div>
                            <div class="column-downloaded">
        <?= $l['install_count'] ?>活跃安装				
                            </div>
                            <div class="column-compatibility">
                                <span class="compatibility-compatible">该插件<strong>兼容</strong>于您当前使用的YiiShop版本。</span>				</div>
                        </div>
                    </div>
    <?php } ?>
<?php } ?>
        </div>
    </div>
</form>