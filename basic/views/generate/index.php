<div class="main-div">
    <form method="post" action="/generate/index"enctype="multipart/form-data" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">表名</td>
                <td>
                    <input type="text" name="table_name" class="table_name" maxlength="60" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">模块名</td>
                <td>
                    <input type="text" name="module_name" class="module_name" maxlength="60" value="" />
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center"><br />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>