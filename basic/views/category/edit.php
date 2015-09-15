<script type="text/javascript" src="/js/jquery.ztree.core-3.5.js"></script>
<div class="main-div">
    <form action="/category/edit" method="post" name="theForm" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $commonData['id']; ?>"/>
        <table width="100%" id="general-table">
            <tr>
                <td class="label">分类名称:</td>
                <td>
                    <input type='text' name='name' maxlength="20" value="<?php echo $commonData['name']; ?>" size='27' />
                </td>
            </tr>
            <tr>
                <td class="label">顶级分类:</td>
                <td>
                    <input type="text" placeholder="不选择默认为顶级分类下" name="parent_text" disabled id="parent_text" maxlength="60" value="<?php echo $commonData['parent_id']; ?>"/>
                    <input type="hidden" name="parent_id" id="parent_id" value="<?php isset($commonData['parent_id'])?$commonData['parent_id']:1; ?>"/>
                    <!--生成树状结构的代码-->
                    <ul id="tree" class="ztree"></ul>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input type="radio" name="status" value="1" /> 是
                    <input type="radio" name="status" value="0" /> 否
                </td>
            </tr>
            <tr>
                <td class="label">描述:</td>
                <td>
                    <textarea name="intro" cols="60" rows="4"><?php echo $commonData['intro']; ?></textarea>
                </td>
            </tr>
        </table>
        <div class="button-div">
            <input type="button" class="button ajax-post" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
    </form>
</div>
<script>
    $(function(){
        $(":radio[name='status']").val([<?php if(!empty($commonData['status'])){echo $commonData['status'];}else{echo 1;} ?>]);
        var setting = {
            data: {
                simpleData: {
                    enable: true,
                    pIdKey : "parent_id"
                }
            },
            callback: {  //event事件, treeId就是被替换的ul标签的id,  treeNode: 点击的节点
                'onClick': function(event, treeId, treeNode, clickFlag){
                    console.debug(treeNode);
                    console.debug(treeId);
                    //将点击的节点上的name,parent_id赋值到表单中
                    $('#parent_text').val(treeNode.name);
                    $('#parent_id').val(treeNode.id);//将选中的节点id作为父分类的id
                }
            }
        };

        var zNodes = <?php echo $tree; ?>; //取出php给页面分配的json数据

        //将id='tree'的ul替换成一个树状结构
        var treeObj =$.fn.zTree.init($("#tree"), setting, zNodes);

        //var treeObj = $.fn.zTree.getZTreeObj("tree"); //参数为id的值,不加#
        treeObj.expandAll(true);
        var parentNode= treeObj.getNodeByParam('id',<?php echo $commonData['parent_id']; ?>); //根据id(该id是数据库中的)找到指定的节点..
        treeObj.selectNode(parentNode); //选中找到的节点
        $("#parent_text").val(parentNode.name);


    });

</script>