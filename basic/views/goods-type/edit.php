
<div class="main-div">
    <form method="post" action="/goods-type/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $commonData['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" class="name" maxlength="60" value="<?php echo $commonData['name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" class="sort" maxlength="40" size="15" value="<?php echo $commonData['name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td class="status">
                    <input type="radio" name="status" value="1"  /> 是
                    <input type="radio" name="status" value="2"  /> 否
                </td>
            </tr>
            <tr>
                <td class="label">描述</td>
                <td>
                    <textarea  name="intro" class="intro" cols="60" rows="4"  ><?php echo $commonData['name']; ?></textarea>
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