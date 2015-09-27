
<div class="main-div">
    <form method="post" action="/admin/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $commonData['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">用户名</td>
                <td>
                    <input type="text" <?php if(!empty($commonData['id'])){echo 'READONLY style="color:#a9a9a9"';} ?> name="username" class="name" maxlength="60" value="<?php echo $commonData['username']; ?>" />
                </td>
            </tr>
            <?php if(!empty($commonData['id'])){ ?>
            <tr>
                <td class="label">旧密码</td>
                <td>
                    <input type="password" name="oldpassword" class="name" maxlength="60" value="" />
                </td>
            </tr>
            <?php }  ?>
            <tr>
                <td class="label">密码</td>
                <td>
                    <input type="password" name="password" class="name" maxlength="60" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">确认密码</td>
                <td>
                    <input type="password" name="repassword" class="name" maxlength="60" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">邮箱</td>
                <td>
                    <input type="text" name="email" class="name" maxlength="60" value="<?php echo $commonData['email']; ?>" />
                </td>
            </tr>

            <tr>
                <td class="label">状态</td>
                <td class="status">
                    <input type="radio" name="status" value="1"  /> 启用
                    <input type="radio" name="status" value="2"  /> 禁用
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="button" class="button ajax-post" value=" 确定 " />
                    <input type="submit" class="" value=" 确定 " />
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