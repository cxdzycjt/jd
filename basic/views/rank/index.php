<!--提示框-->
<div id="top-alert" class="fixed alert" style="display: none;">
    <button class="close fixed" style="margin-top: 4px;">×</button>
    <div class="alert-content">这是内容</div>
</div>
<div class="form-div">
    <form action="/rank/index" method="get" name="searchForm">
        <img src="/img/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <input type="text" name="name" size="15" value="<?php echo $name;?>"/>
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>
<form method="post" action="/ranks/del" name="listForm">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th align="left"><input class="J_check_all"  type="checkbox"/>编号</th>
                <th>名称</th>
                <th>积分下线</th>
                <th>积分上线</th>
                <th>折扣率</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
                foreach($models as $rank){
                    ?>
            <tr>
                <td class="first-cell" align="left">
                    <input type="checkbox" name="id[]" value="<?php echo $rank['id']?>"/><?php echo $rank['id']?>
                </td>
                <td class="first-cell" align="center"><?php echo $rank['name']; ?></td>
                <td align="center"><?php echo $rank['score_bottom']; ?></td>
                <td align="center"><?php echo $rank['score_top']; ?></td>
                <td align="center"><?php echo $rank['discount']; ?></td>
                <td align="center">
                    <a class="ajax-get refresh" href="/rank/status/<?php echo $rank['id']; ?>/<?php echo $rank['status']; ?>">
                     <img src="/img/<?php echo $rank['status']; ?>.gif">
                    </a>
                </td>
                <td align="center"><?php echo date('Y-m-d H:i:s',$rank['createTime']); ?></td>
                <td align="center">
                    <a href="/rank/edit/<?php echo $rank['id']; ?>" title="编辑">编辑</a> |
                    <a class="ajax-get refresh"  href="/rank/del/<?php echo $rank['id']; ?>" title="移除">移除</a>
                </td>
            </tr>
            <?php   }   ?>
            <tr>
                <td>
                    <button class="ajax-post" href="/rank/del">删除</button>
                </td>
                <td align="right" nowrap="true" colspan="7">
                    <div id="turn-page">
                        <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>
