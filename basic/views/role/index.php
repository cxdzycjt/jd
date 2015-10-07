
<div class="form-div">
    <form action="/brand/index" name="searchForm">
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
                <th>状态</th>
                <th>描述</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($models as $brand){
                ?>
                <tr>
                    <td class="first-cell" align="left"><input type="checkbox" name="id[]" value="<?php echo $brand['id']?>"/><?php echo $brand['id']?></td>
                    <td class="first-cell" align="center"><?php echo $brand['name']; ?></td>
                    <td align="center">
                        <a class="ajax-get refresh" href="/brand/status/<?php echo $brand['id']; ?>/<?php echo $brand['status']; ?>">
                            <img src="/img/<?php echo $brand['status']; ?>.gif">
                        </a>
                    </td>
                    <td class="first-cell" align="center"><?php echo $brand['intro']; ?></td>
                    <td align="center"><?php echo date('Y-m-d H:i:s',$brand['createTime']); ?></td>
                    <td align="center">
                        <a href="/role/edit/<?php echo $brand['id']; ?>" title="编辑">编辑</a> |
                        <a class="ajax-get refresh"  href="/role/del/<?php echo $brand['id']; ?>" title="移除">移除</a>
                    </td>
                </tr>
            <?php   }   ?>
            <tr>
                <td><button class="J_ajax_post">删除</button></td>
                <td align="right" nowrap="true" colspan="6">
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
            $.get('/brand/del',{'id':id},function(data){
                console.log(data);
                return false;
            });
        });
    });

</script>