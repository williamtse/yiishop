<?php
use yii\helpers\Url;
?>
<style>
    .column-primary{width: 150px}
</style>
<form method="post" id="bulk-action-form">

    <input type="hidden" name="plugin_status" value="all">
    <input type="hidden" name="paged" value="1">

    <input type="hidden" id="_wpnonce" name="_wpnonce" value="1d5fecdf94"><input type="hidden" name="_wp_http_referer" value="/wp-admin/plugins.php">	<div class="tablenav top">

        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text">选择批量操作</label><select name="action" id="bulk-action-selector-top">
                <option value="-1">批量操作</option>
                <option value="activate-selected">启用</option>
                <option value="deactivate-selected">停用</option>
                <option value="update-selected">更新</option>
                <option value="delete-selected">删除</option>
            </select>
            <input type="submit" id="doaction" class="button action" value="应用">
        </div>
        <div class="tablenav-pages one-page"><span class="displaying-num">2项目</span>
            <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
                <span class="paging-input">第<label for="current-page-selector" class="screen-reader-text">当前页</label><input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1" aria-describedby="table-paging">页，共<span class="total-pages">1</span>页</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">›</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
        <br class="clear">
    </div>
    <h2 class="screen-reader-text">插件列表</h2><table class="wp-list-table widefat plugins">
        <thead>
            <tr>
                <td id="cb" class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1">全选</label>
                    <input id="cb-select-all-1" type="checkbox"></td>
                <th scope="col" id="name" class="manage-column column-name column-primary">模块</th>
                <th scope="col" id="description" class="manage-column column-description">描述</th>	
            </tr>
        </thead>

        <tbody id="the-list">
            <?php if(!empty($module_infos)){ ?>
            <?php foreach($module_infos as $k=>$m){ ?>
            <tr class="inactive update" data-slug="akismet" data-plugin="akismet/akismet.php">
                <th scope="row" class="check-column">
                    <label class="screen-reader-text" for="">选择<?=$m['Name']?></label>
                    <input type="checkbox" name="checked[]" value="akismet/akismet.php" id="">
                </th>
                <td class="plugin-title column-primary">
                    <strong><?=$m['Name']?></strong>
                    <div class="row-actions visible">
                        <span class="activate">
                            <a href="<?=($m['actived']?Url::toRoute(['module/unactive']):Url::toRoute(['module/active']))?>&paged=" 
                               class="edit" aria-label="激活Akismet"><?=($m['actived']?'禁用':'启用')?></a> 
                            | 
                        </span>
                        <span class="edit">
                            <a href="<?=Url::toRoute(['module/update','name'=>$k])?>" 
                               class="edit" aria-label="编辑<?=$m['Name']?>">编辑</a> 
                            | 
                        </span>
                        <span class="delete">
                            <a href="<?=Url::toRoute(['module/delete','name'=>$k])?>" 
                               class="delete" aria-label="删除<?=$m['Name']?>">删除</a>
                        </span>
                    </div>
                    <button type="button" class="toggle-row"><span class="screen-reader-text">显示详情</span></button>
                </td>
                <td class="column-description desc">
                    <div class="plugin-description">
                        <p>
                            <?=$m['Description']?>
                        </p>
                    </div>
                    <div class="inactive update second plugin-version-author-uri"><?=$m['Version']?>版本 | 由
                        <a href="https://automattic.com/wordpress-plugins/"><?=$m['Author']?></a>创建 | 
                        <a href="" class="thickbox open-plugin-details-modal" aria-label="关于Akismet的更多信息" data-title="Akismet">查看详情</a>
                    </div>
                </td>
            </tr>
            <tr class="plugin-update-tr" id="akismet-update" data-slug="akismet" data-plugin="akismet/akismet.php">
                <td colspan="3" class="plugin-update colspanchange">
                    <div class="update-message">Akismet有新版本。
                        <a href="" class="thickbox open-plugin-details-modal" aria-label="查看Akismet版本3.2详情">查看3.2版本的详细信息</a>
                        或
                        <a href="" aria-label="现在更新Akismet">现在更新</a>。
                    </div>
                </td>
            </tr>
            <?php }?>
            <?php }?>
        </tbody>

        <tfoot>
            <tr>
                <td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">全选</label><input id="cb-select-all-2" type="checkbox"></td><th scope="col" class="manage-column column-name column-primary">插件</th><th scope="col" class="manage-column column-description">图像描述</th>	</tr>
        </tfoot>

    </table>
    <div class="tablenav bottom">

        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-bottom" class="screen-reader-text">选择批量操作</label><select name="action2" id="bulk-action-selector-bottom">
                <option value="-1">批量操作</option>
                <option value="activate-selected">启用</option>
                <option value="deactivate-selected">停用</option>
                <option value="update-selected">更新</option>
                <option value="delete-selected">删除</option>
            </select>
            <input type="submit" id="doaction2" class="button action" value="应用">
        </div>
        <div class="tablenav-pages one-page"><span class="displaying-num">2项目</span>
            <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
                <span class="screen-reader-text">当前页</span><span id="table-paging" class="paging-input">第1页，共<span class="total-pages">1</span>页</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">›</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">»</span></span></div>
        <br class="clear">
    </div>
</form>

