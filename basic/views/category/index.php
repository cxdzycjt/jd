<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>分类名称</th>
                <th>导航栏</th>
                <th>是否显示</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            <foreach name="list" item="val">
                <tr align="center" class="0">
                    <td align="left" class="first-cell" >
                        <{$val.lev|str_repeat='&nbsp;&nbsp;&nbsp;&nbsp;',###}>
                        <img src="/img/menu_minus.gif" width="9" height="9" border="0" style="margin-left:0em" />
                        <span><a href="javascript:void(0)"><{$val.cat_name}></a></span>
                    </td>
                    <td width="15%"><img src="/img/yes.gif"></td>
                    <td width="15%"><img src="/img/no.gif" /></td>
                    <td width="15%" align="center"><span><{$val.sort_order}></span></td>
                    <td width="30%" align="center">
                        <a href="/category/edit/id/">编辑</a> |
                        <a href="/category/del/id/" title="移除" onclick="">移除</a>
                    </td>
                </tr>
            </foreach>
        </table>
    </div>
</form>