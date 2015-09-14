<div id="top-alert" class="fixed alert" style="display: none;">
    <button class="close fixed" style="margin-top: 4px;">×</button>
    <div class="alert-content">这是内容</div>
</div>
<div class="main-div">
    <form method="post" action="/supplier/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $supplierRow['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" class="name" maxlength="60" value="<?php echo $supplierRow['name']; ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" class="sort" value="<?php if(!empty($supplierRow['sort'])){echo $supplierRow['sort'];}else{echo 1;} ?>" maxlength="40" size="15"/>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td class="status">
                    <input type="radio" name="status"  value="1" /> 是
                    <input type="radio" name="status"  value="2" /> 否
                </td>
            </tr>
            <tr>
                <td class="label">描述</td>
                <td>
                    <textarea  name="intro" class="intro" cols="60" rows="4"><?php echo $supplierRow['intro']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="button" class="button J-post" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    $(function(){
        $(":radio[name='status']").val([<?php if(!empty($supplierRow['status'])){echo $supplierRow['status'];}else{echo 1;} ?>]);
    });
</script>