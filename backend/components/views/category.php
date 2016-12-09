<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

function showOptions($dataProvider) {
    $options = '<div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text">选择批量操作</label>
            <select name="action" id="bulk-action-selector-top">
                <option value="-1">批量操作</option>
                <option value="delete">删除</option>';
    $options .= '</select>
            <input type="submit" id="doaction" class="button action" value="应用">
        </div>';
    $options .= '<div class="tablenav-pages one-page"><span class="displaying-num">' . count($dataProvider) . '项目</span>
            <span class="pagination-links"><span class="tablenav-pages-navspan" aria-hidden="true">«</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">‹</span>
                <span class="screen-reader-text">当前页</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">第1页，共<span class="total-pages">1</span>页</span></span>
                <span class="tablenav-pages-navspan" aria-hidden="true">›</span>
                <span class="tablenav-pages-navspan" aria-hidden="true">»</span></span>
        </div>';
    echo $options;
}

function showTableHeader($params) {
    $head = '<tr>
                <td id="cb" class="manage-column column-cb check-column">
                    <label class="screen-reader-text" for="cb-select-all-1">全选</label>
                    <input id="cb-select-all-1" type="checkbox">
                </td>';
    $head .= '<th scope="col" id="" class="manage-column column-name column-primary sortable desc">
                        <a href="'.Url::toRoute(['category/index','orderby'=>'name','order'=>($params['orderby']=='name'&&$params['order']=='asc'?'desc':'asc')]).'">
                            <span>名称</span>
                            <span class="sorting-indicator"></span>
                        </a>
                    </th>';
    $head.='<th scope="col" id="" class="manage-column column-name column-primary sortable desc">
                        <a href="'.Url::toRoute(['category/index','orderby'=>'count','order'=>($params['orderby']=='count'&&$params['order']=='asc'?'desc':'asc')]).'">
                            <span>商品数量</span>
                            <span class="sorting-indicator"></span>
                        </a>
                    </th>';
    $head .= '</tr>';
    echo $head;
}

$firstColumn = $params['firstColumn'];
?>
<form id="posts-filter" method="post">
    <input type="hidden" name="taxonomy" value="category">
    <input type="hidden" name="post_type" value="post">

    <input type="hidden" id="_wpnonce" name="_wpnonce" value="b619d5d140"><input type="hidden" name="_wp_http_referer" value="/wp-admin/edit-tags.php?taxonomy=category">	
    <div class="tablenav top">
        <?= showOptions($dataProvider) ?>
        <br class="clear">
    </div>
    <h2 class="screen-reader-text">分类列表</h2><table class="wp-list-table widefat fixed striped tags">
        <thead>
            <?= showTableHeader($params) ?>
        </thead>

        <tbody id="the-list" data-wp-lists="list:tag">
            <?php if (!empty($dataProvider)) { ?>
                <?php foreach ($dataProvider as $row) { ?>
                    <tr id="row-<?= $row['id'] ?>">
                        <th scope="row" class="check-column">
                            <label class="screen-reader-text" for="cb-select-<?=$row['id']?>">选择<?=$row['name']?></label>
                            <input type="checkbox" name="delete_categories[]" value="<?=$row['id']?>" id="cb-select-<?=$row['id']?>"></th>
                            <td class="name column-name has-row-actions column-primary" data-colname="名称">
                                <strong>
                                    <a class="row-title" 
                                           href="#" 
                                       aria-label="">
                                           <?= $row['name'] ?>
                                    </a>
                                </strong>
                                    <br>
                                    <div class="row-actions">
                                        <span class="edit">
                                            <a href="<?=Url::toRoute(['category/update','id'=>$row['id']])?>" aria-label="编辑“<?=$row['name']?>”">编辑</a> | 
                                        </span>
                                        <span class="inline hide-if-no-js">
                                            <a href="<?=Url::toRoute(['category/update','id'=>$row['id']])?>" class="editinline aria-button-if-js" aria-label="快速编辑“<?=$row['name']?>”" role="button">快速编辑</a> 
                                            | 
                                        </span>
                                        <?php if($row['count']==0){ ?>
                                        <span class="delete">
                                            <a href="<?=Url::toRoute(['category/delete','id'=>$row['id']])?>" class="delete-tag aria-button-if-js" aria-label="删除“<?=$row['name']?>”" role="button">删除</a> | 
                                        </span>
                                        <?php }?>
                                        <span class="view">
                                            <a href="<?=Url::toRoute(['category/update','id'=>$row['id']])?>" aria-label="查看“<?=$row['name']?>”存档">查看</a>
                                        </span>
                                    </div>
                                    <button type="button" class="toggle-row"><span class="screen-reader-text">显示详情</span></button>
                            </td>
                            <td class="description column-description" data-colname="商品数量"><p><?=$row['count']?></p></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <th colspan="3">暂无数据</th>
                </tr>
            <?php } ?>
        </tbody>

        <tfoot>
            <?= showTableHeader($params) ?>
        </tfoot>

    </table>
    <div class="tablenav bottom">
        <?= showOptions($dataProvider) ?>
        <br class="clear">
    </div>

</form>

<div class="form-wrap edit-term-notes">
</div>

