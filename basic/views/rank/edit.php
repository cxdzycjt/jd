
<div class="main-div">
    <form method="post" action="/rank/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $commonData['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" class="name" maxlength="60" value="<?php echo $commonData['name']; ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">经验下限</td>
                <td>
                    <input type="text" name="score_bottom" class="score_bottom" maxlength="60" value="<?php echo $commonData['score_bottom']; ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">经验上限</td>
                <td>
                    <input type="text" name="score_top" class="score_top" maxlength="60" value="<?php echo $commonData['score_top']; ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">折扣率%</td>
                <td>
                    <input type="text" name="discount" class="discount" maxlength="60" value="<?php echo $commonData['discount']; ?>" />
                    <span class="require-field">*</span>
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
                <td colspan="2" align="center"><br />
                    <input type="button" class="button ajax-post" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    $(function(){
        $(":radio[name='status']").val([<?php if(!empty($commonData['status'])){echo $commonData['status'];}else{echo 1;} ?>]);

    });
</script>