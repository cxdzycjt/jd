
<div class="form-div">
    <form action="/permission/index" name="searchForm">
        <img src="/img/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <input type="text" name="name" size="15" value="<?php echo isset($name)?$name:''; ?>" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th align="left"><input class="J_check_all"  type="checkbox"/>编号</th>
                <th>名称</th>
                <th>URL</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($models as $permission){
                ?>
                <tr>
                    <td class="first-cell" align="left"><input type="checkbox" name="id[]" value="<?php echo $permission['id']?>"/><?php echo $permission['id']?></td>
                    <td class="first-cell" align="center"><?php echo $permission['name']; ?></td>
                    <td class="first-cell" align="center"><?php echo $permission['url']; ?></td>
                    <td align="center">
                        <a class="ajax-get refresh" href="/brand/status/<?php echo $permission['id']; ?>/<?php echo $permission['status']; ?>">
                            <img src="/img/<?php echo $permission['status']; ?>.gif">
                        </a>
                    </td>
                    <td align="center"><?php echo date('Y-m-d H:i:s',$permission['createTime']); ?></td>
                    <td align="center">
                        <a href="/permission/edit/<?php echo $permission['id']; ?>" title="编辑">编辑</a> |
                        <a class="ajax-get refresh"  href="/permission/del/<?php echo $permission['id']; ?>" title="移除">移除</a>
                    </td>
                </tr>
            <?php   }   ?>

        </table>
    </div>
</form>
<script type="text/javascript">
    $(function(){
        //批量删除
        $('.J_ajax_post').click(function(){
            var id =  $(":checked[name='id[]']").serialize();
            $.get('/permission/del',{'id':id},function(data){
                console.log(data);
                return false;
            });
        });
    });

</script>