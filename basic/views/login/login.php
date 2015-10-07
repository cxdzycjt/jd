<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/general.css" rel="stylesheet" type="text/css" />
    <link href="/css/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js" ></script>
    <script type="text/javascript" src="/js/common.js" ></script>
</head>
<body style="background: #278296;color:white">
<form method="post" action="/login/login" >
    <table cellspacing="0" cellpadding="0" style="margin-top:100px" align="center">
        <tr>
            <td>
                <img src="/img/login.png" width="178" height="256" border="0" alt="ECSHOP" />
            </td>
            <td style="padding-left: 50px">
                <table>
                    <tr>
                        <td>管理员姓名：</td>
                        <td>
                            <input type="text" name="username" />
                        </td>
                    </tr>
                    <tr>
                        <td>管理员密码：</td>
                        <td>
                            <input type="password" name="password" />
                        </td>
                    </tr>
<!--                    <tr>
                        <td>验证码：</td>
                        <td>
                            <input type="text" name="captcha" class="capital" />
                        </td>
                    </tr>-->
                  <!--  <tr>
                        <td colspan="2" align="right">
                            <img src="" />
                        </td>
                    </tr>-->
                    <tr >
                        <td class="J-login" colspan="2" align="center" style="color: red;display: none;"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="checkbox" value="1" name="remember" id="remember" />
                            <label for="remember">请保存我这次的登录信息。</label>
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="submit" value="进入管理中心" class="button J-ajax-post" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
</body>
<script>
    $(".J-ajax-post").click(function(){
        //删除时使用ajax和提交表单时使用ajax
        var target = $(this).parents('form').prop('action') ;
        var params = $(this).parents('form').serialize();
        var obj = this;
        console.log(target);
        $.post(target,params,function(data){
            if(data.status==2){
               $('.J-login').show().html(data.message);
                return false;
            }else if(data.status==3){
                $('.J-login').show().html(data.message);
                return false;
            }else if(data.status==4){
                $('.J-login').show().html(data.message);
                return false;
            }else{
                location.href = data.url;
            }
             return false;
        },'json');
        return false; //禁止执行表单提交
    });
</script>