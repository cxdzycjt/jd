
<div class="main-div">
    <form method="post" action="/attribute/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $commonData['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" class="name" maxlength="60" value="<?php echo $commonData['name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">商品类型</td>
                <td>
                    <select style="width: 145px;">
                        <option value="">请选择....</option>
                        <?php
                        foreach($goodsType as $type){   ?>
                            <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                        <?php  }  ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">属性</td>
                <td>
                    <input type="radio" name="type" value="1"/> 唯一
                    <input type="radio" name="type" value="2"/> 多值
                </td>
            </tr>
            <tr>
                <td class="label">录入类型</td>
                <td>
                    <input type="radio" name="input_type" value="1"/> 手工录入
                    <input type="radio" name="input_type" value="2"/> 从下面的列表中选择(一行代表一个可选值)
                    <input type="radio" name="input_type" value="3"/> 多行文本框
                </td>
            </tr>
            <tr>
                <td class="label">备选值</td>
                <td>
                    <textarea id="textValue" name="value" class="value" cols="60" rows="4" disabled ><?php echo $commonData['value']; ?></textarea>
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
        $(":radio[name='type']").val([<?php if(!empty($commonData['type'])){echo $commonData['type'];}else{echo 1;} ?>]);
        $(":radio[name='input_type']").val([<?php if(!empty($commonData['input_type'])){echo $commonData['input_type'];}else{echo 1;} ?>]);
        /*****类型选择*****/
        $(":radio[name='type']").click(function(){
            if(this.value==2){
                var inputType = $(":radio[name='input_type']");
                inputType.val([2]);
                inputType.each(function(){
                    if(!this.checked){
                        $(this).attr('disabled','disabled');
                        $(this).attr('disabled','disabled');
                    }
                });
                $('#textValue').removeAttr('disabled')
            }else{
               var inputType = $(":radio[name='input_type']");
                inputType.removeAttr('disabled');
                if(inputType.filter(':checked').val()==2){
                    $('#textValue').removeAttr('disabled')
                }else{
                    $('#textValue').attr('disabled','disabled')
                }
            }
        });
        $(":radio[name='input_type']").click(function(){
            if($(this).val()==2){
                $('#textValue').removeAttr('disabled')
            }else{
                $('#textValue').attr('disabled','disabled')
            }
        });
    });

</script>