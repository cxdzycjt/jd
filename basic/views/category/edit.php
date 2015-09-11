<div class="main-div">
    <form action="__GROUP__/Category/categoryAdd" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='text' name='cat_name' maxlength="20" value='<{$row.cat_name}>' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id">
                        <option value="0">顶级分类</option>
                        <foreach name="list" item="val">
                            <option value="<{$val.cat_id}>" <if condition="($val.cat_id) eq ($row.parent_id)"> selected="selected"</if>><{$val.lev|str_repeat='&nbsp;&nbsp;',###}><{$val.cat_name}></option>
                        </foreach>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">排序:</td>
                <td>
                    <input type="text" name='sort_order'  value="<{$row.sort_order}>" size="15" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input type="radio" name="is_show" value="1"  <if condition="$row.is_show eq 1"> checked="true" </if> /> 是
                    <input type="radio" name="is_show" value="0" <if condition="$row.is_show eq 0"> checked="true" </if> /> 否
                </td>
            </tr>
            <tr>
                <td class="label">导航显示:</td>
                <td>
                    <input type="radio" name="is_nav" value="1"  <if condition="$row.is_show eq 1"> checked="true" </if> /> 是
                    <input type="radio" name="is_nav" value="0" <if condition="$row.is_show eq 0"> checked="true" </if> /> 否
                </td>
            </tr>
            <tr>
                <td class="label">关键字:</td>
                <td>
                    <input type="text" name="keywords" value='<{$row.keywords}>' size="50">
                </td>
            </tr>
        </table>
        <div class="button-div">
            <input type="submit" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
    </form>
</div>