<script type="text/javascript" src="/js/jquery.ztree.core-3.5.js"></script>
<link  type="text/css" href="/css/zTreeStyle/zTreeStyle.css" rel="stylesheet">
<div class="main-div">
    <form method="post" action="/permission/edit"enctype="multipart/form-data" >
        <input type="hidden" name="id" class="id" value="<?php echo $commonData['id']; ?>"/>
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">名称</td>
                <td>
                    <input type="text" name="name" class="name" maxlength="60" value="<?php echo $commonData['name']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">URL</td>
                <td>
                    <input type="text" name="url" class="name" maxlength="60" value="<?php echo $commonData['url']; ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">顶级分类:</td>
                <td>
                    <input type="text" placeholder="不选择默认为顶级分类下" name="parent_text" disabled id="parent_text" maxlength="60" value="<?php echo $commonData['parent_id']; ?>"/>
                    <input type="hidden" name="parent_id" id="parent_id" value="<?php if(!empty($commonData['parent_id'])){echo $commonData['parent_id']; }else{echo 1;} ?>"/>
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
            data: {
                simpleData: {
                    enable: true,
                    pIdKey : "parent_id"   //由于ztree默认PIdKey为:PId,但是查询出来的是parent_id,在这里重新指定
                }
            },
            callback: {           //event事件, treeId就是被替换的ul标签的id,  treeNode: 点击的节点
                'onClick': function(event, treeId, treeNode, clickFlag){
                    //将点击的节点上的name,parent_id赋值到表单中
                    $('#parent_text').val(treeNode.name);
                    $('#parent_id').val(treeNode.id);           //将选中的节点id作为父分类的id
                }
            }
        };
        var zNodes = <?php echo $tree; ?>;          //取出php给页面分配的json数据
        var treeObj =$.fn.zTree.init($("#tree"), setting, zNodes);
        //var treeObj = $.fn.zTree.getZTreeObj("tree"); //参数为id的值,不加#
        treeObj.expandAll(true);            //展开
        var parent_id = <?php echo  $commonData['parent_id']?$commonData['parent_id']:"''"; ?>;
        if(parent_id != ''){
            var parentNode= treeObj.getNodeByParam('id',<?php echo  $commonData['parent_id']?$commonData['parent_id']:"''"; ?>); //根据id(该id是数据库中的)找到指定的节点..
            treeObj.selectNode(parentNode); //选中找到的节点
            $("#parent_text").val(parentNode.name);
        }else{
        }

    });

</script>