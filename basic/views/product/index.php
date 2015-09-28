<!--提示框-->
<div id="top-alert" class="fixed alert" style="display: none;">
    <button class="close fixed" style="margin-top: 4px;">×</button>
    <div class="alert-content">这是内容</div>
</div>
<form method="post" action="/product/index" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="tree">
            <tr>
                <th align="left"><input class="J_check_all"  type="checkbox"/>编号</th>
                <?php   foreach($productList['rows'] as $product){  ?>
                <th><?php echo $product['name'] ;?></th>
                <?php  }  ?>
                <th>价格</th>
                <th>库存</th>
            </tr>
            <?php
              foreach($productList['result'] as $result){
            ?>
                <tr>
                    <td class="first-cell" align="left">
                        <input type="checkbox" name="id[]"  <?php foreach($arrProduct as $k=>$v){if($k==$result['ids']){echo 'checked'; }} ?> value="<?php echo $result['ids']?>"/>
                    </td>
                    <?php $i=0;  foreach($result as $id){ if($i>=1){ ?>
                        <td align="center" width="20%"><?php echo $id; ?></td>
                    <?php  }$i++;} ?>
                    <td align="center" width="20%">
                        <input type="text" value="<?php foreach($arrProduct as $k=>$v){if($k==$result['ids']){echo $v['price']; }} ?>" name="price[<?php echo $result['ids']; ?>]"/>
                    </td>
                    <td align="center" width="20%">
                        <input type="text" value="<?php foreach($arrProduct as $k=>$v){if($k==$result['ids']){echo $v['stock']; }} ?>" name="stock[<?php echo $result['ids']; ?>]"/>
                    </td>
                </tr>
            <?php   }   ?>
        </table>
        <div style="text-align: center">
            <input type="hidden" name="goods_id" value="<?php echo $goods_id?>"/>
            <input type="button" class="button ajax-posts" value=" 确定 " />
        </div>
    </div>
</form>
<script>
    $(function(){
        /**
         * post提交
         */
        $(".ajax-posts").click(function(){
            //删除时使用ajax和提交表单时使用ajax
            var target = $(this).attr('href');
            var params = $(this).parents('form').serialize();  //得到选中的复选框
            var obj = this;
            $.post(target,params,function(data){
                updateAlert(data,obj);
            },'json');
            return false; //禁止执行表单提交
        });
    })
</script>
