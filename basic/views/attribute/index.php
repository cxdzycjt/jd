
<div class="form-div">
    <form action="/attribute/index" name="searchForm">
        <img src="/img/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <input type="text" name="name" size="15" value="<?php echo $name; ?>" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th align="left"><input class="J_check_all"  type="checkbox"/>编号</th>
                <th>名称</th>
                <th>商品类型</th>
                <th>属性</th>
                <th>录入类型</th>
                <th>备选值</th>
                <th>排序</th>
                <th>简介</th>
                <th>是否显示</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($models as $attribute){
                ?>
                <tr>
                    <td class="first-cell" align="left"><input type="checkbox" name="id[]" value="<?php echo $attribute['id']?>"/><?php echo $attribute['id']?></td>
                    <td class="first-cell" align="center"><?php echo $attribute['name']; ?></td>
                    <td class="first-cell" align="center"><?php echo $attribute['goodsType_id']; ?></td>
                    <td class="first-cell" align="center"><?php echo $attribute['type']; ?></td>
                    <td class="first-cell" align="center"><?php echo $attribute['input_type']; ?></td>
                    <td class="first-cell" align="center"><?php echo $attribute['value']; ?></td>
                    <td align="center"><?php echo $attribute['sort']; ?></td>
                    <td align="center"><?php echo $attribute['intro']; ?></td>
                    <td align="center">
                        <a class="ajax-get refresh" href="/brand/status/<?php echo $attribute['id']; ?>/<?php echo $attribute['status']; ?>">
                            <img src="/img/<?php echo $attribute['status']; ?>.gif">
                        </a>
                    </td>
                    <td align="center"><?php echo date('Y-m-d H:i:s',$attribute['createTime']); ?></td>
                    <td align="center">
                        <a href="/attribute/edit/<?php echo $attribute['id']; ?>" title="编辑">编辑</a> |
                        <a class="ajax-get refresh"  href="/attribute/del/<?php echo $attribute['id']; ?>" title="移除">移除</a>
                    </td>
                </tr>
            <?php   }   ?>
            <tr>
                <td><button class="J_ajax_post">删除</button></td>
                <td align="right" nowrap="true" colspan="10">
                    <div id="turn-page">
                        <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>
<script type="text/javascript">
    $(function(){
        //批量删除
        $('.J_ajax_post').click(function(){
            var id =  $(":checked[name='id[]']").serialize();
            $.get('/attribute/del',{'id':id},function(data){
                console.log(data);
                return false;
            });
        });
    });

</script>