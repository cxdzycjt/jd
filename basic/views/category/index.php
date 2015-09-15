<script type="text/javascript" src="/js/jquery.treegrid.js" ></script>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="tree">
            <tr>
                <th>分类名称</th>
                <th>是否显示</th>
                <th>描述</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
                foreach($models as $category){
            ?>
                    <tr class="treegrid-<?php echo $category['id']; ?>" <?php if($category['parent_id']!=1){echo 'treegrid-parent-'.$category['parent_id'];}?>  >
                        <td class="first-cell"><?php echo $category['name']; ?></td>
                        <td align="center" width="10%"><a class="ajax-get" href="/category/status/<?php echo $category['id']; ?>/<?php echo $category['status']; ?>">
                                <img src="/img/<?php echo $category['status']; ?>.gif">
                            </a></td>
                        <td align="center" ><?php echo $category['intro']; ?></td>
                        <td align="center" width="10%"><?php echo date('Y-m-d H:i:s',$category['createTime']); ?></td>
                        <td align="center" width="10%">
                            <a href="/category/edit/<?php echo $category['id']; ?>" title="编辑">编辑</a> |
                            <a class="ajax-get refresh"  href="/category/del/<?php echo $category['id']; ?>"  title="移除">移除</a>
                        </td>
                    </tr>
            <?php   }   ?>
        </table>
    </div>
</form>
<script type="text/javascript">
    $(function(){
        $('#tree').treegrid();
    });

</script>

