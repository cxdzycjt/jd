<div class="form-div">
    <form action="" name="searchForm">
        <img src="/img/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <input type="text" name="brand_name" size="15" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>名称</th>
                <th>排序</th>
                <th>描述</th>
                <th>是否显示</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
                foreach($supplierList as $supplier){
            ?>
            <tr>
                <td class="first-cell" align="center"><?php echo $supplier['supplier_name']; ?></td>
                <td align="center"><?php echo $supplier['supplier_sort']; ?></td>
                <td align="center"><?php echo $supplier['supplier_intro']; ?></td>
                <td align="center"><?php if($supplier['supplier_status']==1){echo '是';}else{echo '否';} ?></td>
                <td align="center"><?php echo date('Y-m-d H:i:s',$supplier['createTime']); ?></td>
                <td align="center">
                    <a href="/supplier/edit/<?php echo $supplier['supplier_id']; ?>" title="编辑">编辑</a> |
                    <a href="/supplier/del/<?php echo $supplier['supplier_id']; ?>" title="编辑">移除</a>
                </td>
            </tr>
            <?php   }   ?>
            <tr>
                <td align="right" nowrap="true" colspan="6">
                    <div id="turn-page">
                        <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages,]) ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>