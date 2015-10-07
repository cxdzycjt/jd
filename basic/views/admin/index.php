
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
                <th>用户名</th>
                <th>邮箱</th>
                <th>添加时间</th>
                <th>最后登录时间</th>
                <th>最后登录IP</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php
            foreach($models as $admin){
                ?>
                <tr>
                    <td class="first-cell" align="left"><input type="checkbox" name="id[]" value="<?php echo $admin['id']?>"/><?php echo $admin['id']?></td>
                    <td class="first-cell" align="center"><?php echo $admin['username']; ?></td>
                    <td align="center"><?php echo $admin['email']; ?></td>
                    <td align="center"><?php echo date('Y-m-d H:i:s',$admin['createTime']); ?></td>
                    <td align="center"><?php echo date('Y-m-d H:i:s',$admin['last_login_time']); ?></td>
                    <td align="center"><?php echo long2ip($admin['last_login_ip']); ?></td>
                    <td align="center">
                        <a class="ajax-get refresh" href="/admin/status/<?php echo $admin['id']; ?>/<?php echo $admin['status']; ?>">
                            <img src="/img/<?php echo $admin['status']; ?>.gif">
                        </a>
                    </td>
                    <td align="center">
                        <a href="/admin/edit/<?php echo $admin['id']; ?>" title="编辑">编辑</a> |
                        <a class="ajax-get refresh"  href="/admin/del/<?php echo $admin['id']; ?>" title="移除">移除</a>
                    </td>
                </tr>
            <?php   }   ?>
            <tr>
                <td><button class="J_ajax_post">删除</button></td>
                <td align="right" nowrap="true" colspan="7">
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
            $.get('/admin/del',{'id':id},function(data){
                console.log(data);
                return false;
            });
        });
    });

</script>