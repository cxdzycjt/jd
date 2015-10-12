<script type="text/javascript" src="/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="/js/jquery.ztree.excheck-3.5.js"></script>
<link  type="text/css" href="/css/zTreeStyle/zTreeStyle.css" rel="stylesheet">
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
                <td class="label">权限选择</td>
                <td>
                    <?php foreach($roleRows as $role){ ?>
                    <input type="checkbox" name="role_ids[]"  <?php foreach($adminRoleData as $data){if($data['role_id']==$role['id']){echo 'checked';}} ?> class="name" maxlength="60" value="<?php echo $role['id']; ?>" /><?php echo $role['name']; ?>
                    <?php  }  ?>
                </td>
            </tr>
            <tr>
                <td class="label">额外权限</td>
                <td>
                    <input type="hidden" name="permission_ids" id="permission_ids" />
                    <!--生成树状结构的代码-->
                    <ul id="tree" class="ztree"></ul>
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
        var setting = {
            check:{
                enable:true
            },
            data: {
                simpleData: {
                    enable: true,
                    pIdKey : "parent_id"   //由于ztree默认PIdKey为:PId,但是查询出来的是parent_id,在这里重新指定
                }
            },
            callback: {      //event事件, treeId就是被替换的ul标签的id,  treeNode: 点击的节点
                'onCheck': function(event, treeId, treeNode){
                    var treeObj = $.fn.zTree.getZTreeObj(treeId);       //得到当前ztree对象
                    var checkedNodes = treeObj.getCheckedNodes(true);   //得到被选中的节点
                    console.log(checkedNodes);
                    var checkedId = [];
                    for(var i=0;i<checkedNodes.length;++i){
                        var id = checkedNodes[i].id;
                        checkedId[checkedId.length] = id;   //将选中每一个放到数组中
                    }
                    $('#permission_ids').val(checkedId.join(','));  //将拼接起来的id放到permission_ids 隐藏域中
                }
            }
        };
        var zNodes = <?php echo $tree; ?>;          //取出php给页面分配的json数据
        var treeObj =$.fn.zTree.init($("#tree"), setting, zNodes);
        //var treeObj = $.fn.zTree.getZTreeObj("tree"); //参数为id的值,不加#
        treeObj.expandAll(true);            //展开
        var id = <?php echo  $commonData['id']?$commonData['id']:"''"; ?>;
        var permission = <?php  echo $admin_permission ; ?>;
        if(id != ''){
            for(var i= 0,len=permission.length;i<len;++i){
                var parentNode= treeObj.getNodeByParam('id',permission[i]); //根据id(该id是数据库中的)找到指定的节点..
                treeObj.checkNode(parentNode,true,false,true); //出发上面onCheck事件
            }
        }else{
        }
    });

</script>