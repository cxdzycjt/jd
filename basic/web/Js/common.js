$(function(){
    //手动关闭提示框
    $('#top-alert .close').click(function(){
        $('#top-alert').hide('fast');
    });
    //批量选中
    $('.J_check_all').change(function(){
        $(":checkbox[name='id[]']").attr('checked',this.checked);  //选中和取消全部的
    });
    $(":checkbox[name='id[]']").change(function(){
        var length = $(":checkbox[name='id[]']:not(:checked)").length;   //找到没有选中的个数
        $('.J_check_all').attr('checked',length==0);
    });
    /**
     * post提交
     */
    $(".ajax-post").click(function(){
        //删除时使用ajax和提交表单时使用ajax
        var target = $(this).attr('href') ||$(this).parents('form').prop('action') ; //得到点击按钮上面的href连接

        var params = $(":checked[name='id[]']").serialize() || $(this).parents('form').serialize();  //得到选中的复选框
        var obj = this;
        $.post(target,params,function(data){
            updateAlert(data,obj);
        },'json');
        return false; //禁止执行表单提交
    });
    /**
     * get提交
     */
    $('.ajax-get').click(function(){
        var target = this.href;  //得到a标签上的href地址
        var obj = this;  //记录a标签对象
        $.get(target,function(data){
            updateAlert(data,obj);
        },'json');
        return false;
    });
});

/*
 该方法专门用来做提示
 */
function updateAlert(data,obj){
    if(data.status){ //操作成功
        //>>1.找到提示框
        var top_alert = $("#top-alert");
        top_alert.show('fast'); //显示提示框
        top_alert.addClass('alert-success');//加入成功的样式
        $(".alert-content").html(data.message); //加入提示内容
        setTimeout(function(){
            //有url跳转,没有url直接关闭提示框
            if(data.status){
                location.href = data.url;
            }else{
                $("#top-alert").hide('fast');
            }
        },500);
    }else{       //操作失败
        var top_alert = $("#top-alert");
        top_alert.show('fast'); //显示提示框
        top_alert.addClass('alert-error');//加入成功的样式
        $(".alert-content").html(data.message); //加入提示内容
        window.setTimeout(function(){
            if(data.url){
                location.href = data.url;
            }else if($(obj).hasClass('refresh')){ //点击的标签上有class=refresh 要自己刷新
                location.reload();
            }else{
                $("#top-alert").hide('fast');
            }
        },500);
    }
}