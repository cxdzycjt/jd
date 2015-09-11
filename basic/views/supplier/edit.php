<div class="main-div">
    <form method="post" action="/supplier/edit"enctype="multipart/form-data" >
        <input type="hidden" name="supplier_id" value="<?php echo $supplierRow['supplier_id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="supplier_name" maxlength="60" value="<?php echo $supplierRow['supplier_name']; ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="supplier_sort" value="<?php if(!empty($supplierRow['supplier_sort'])){echo $supplierRow['supplier_sort'];}else{echo 1;} ?>" maxlength="40" size="15"/>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="supplier_status" value="1" /> 是
                    <input type="radio" name="supplier_status" value="2" /> 否
                </td>
            </tr>
            <tr>
                <td class="label">描述</td>
                <td>
                    <textarea  name="supplier_intro" cols="60" rows="4"><?php echo $supplierRow['supplier_intro']; ?></textarea>
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
<script>
    $(function(){
        $(":radio[name='supplier_status']").val([<?php if(!empty($supplierRow['supplier_status'])){echo $supplierRow['supplier_status'];}else{echo 1;} ?>]);
    })
</script>