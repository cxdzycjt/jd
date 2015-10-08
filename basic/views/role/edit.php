<script type="text/javascript" src="/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" src="/js/jquery.ztree.excheck-3.5.js"></script>
<link  type="text/css" href="/css/zTreeStyle/zTreeStyle.css" rel="stylesheet">
<div class="main-div">
    <form method="post" action="/role/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $commonData['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" class="name" maxlength="60" value="<?php echo $commonData['name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">权限:</td>
                <td>
                    <input type="hidden" name="permission_ids" id="permission_ids" />
                    <!--生成树状结构的代码-->
                    <ul id="tree" class="ztree"></ul>
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
        var permission = <?php  echo $role_permission ; ?>;
        if(id != ''){
            for(var i= 0,len=permission.length;i<len;++i){
                var parentNode= treeObj.getNodeByParam('id',permission[i]); //根据id(该id是数据库中的)找到指定的节点..
                treeObj.checkNode(parentNode,true,false,true); //出发上面onCheck事件
            }
        }else{
        }
    });

</script>