
<div class="main-div">
    <form method="post" action="/brand/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $commonData['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">品牌名称</td>
                <td>
                    <input type="text" name="name" class="name" maxlength="60" value="<?php echo $commonData['name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <input type="file" id="upload-logo"/>
                    <div class="upload-img-box" style="display: <?php if(empty($commonData['logo'])){echo 'none';}else{} ?>">
                        <div class="upload-pre-item">
                            <img src="<?php echo $commonData['logo']; ?>" alt=""/>
                            <input type="hidden" name="logo" value="<?php echo $commonData['logo']; ?>"/>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" class="sort" maxlength="40" size="15" value="<?php echo $commonData['sort']; ?>" />
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
                <td class="label">品牌描述</td>
                <td>
                    <textarea  name="intro" class="intro" cols="60" rows="4"  ><?php echo $commonData['intro']; ?></textarea>
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
        /**图片上传**/
        $('#upload-logo').uploadify({  //将指定的上传表单替换成Uploadify上传
            'swf'      : '/uploadify/uploadify.swf',    //指定flash的路径,该路径必须是一个相对路径,不能够是一个http的网络地址
            'uploader' : "/upload/add", //处理上传文件的后台PHP代码
           // 'fileObjName' : 'logo',  以FileData上传到服务器上
            'height' : 25,   //指定上传按钮的高
            'width' : 150,   //指定上传按钮的宽
            "buttonText"      : "上传图片", //指定上传按钮上的文字
           // 'formData'      : {'dir' : 'brand'},  //上传时传递过去的参数,用来指定上传到哪个空间中
            'fileTypeExts' : '*.gif; *.jpg; *.png;*.bmp;*.jpeg',  //限定上传的文件类型
            'debug'    : false,   //是否处于调试模式
            'onUploadSuccess' : function(file,data){  //上传成功后处理, data为ajax返回的数据
                eval('var data = '+data); //将json字符串变成json对象
                if(data.status){ //上传成功之后取出data中的pic,将图片地址设置到到图片的src中和隐藏域中
                    var img = $(".upload-pre-item img");
                    img.attr('src',data.save_url);  //url和data.pic组成网络图片地址
                    $(".upload-pre-item :hidden").val(data.save_url); //设置为隐藏域中.为了提交表单到服务器上
                    $('.upload-img-box').show(); //显示放图片的div
                }
            },
            'onFallback' : function(){ //失败后的处理方案
                alert('未检测到兼容版本的Flash.');
            }
        });


    });

</script>