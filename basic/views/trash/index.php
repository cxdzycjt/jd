<div class="form-div">
    <form action="/goods/index" name="searchForm" method="get">
        <img src="/img/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 分类 -->
        <select name="category_id">
            <option value="">所有分类</option>
            <?php foreach(json_decode($category,true) as $cate){ ?>
                <option <?php if($category_id==$cate['id']){echo 'selected';}?> value="<?php echo $cate['id']; ?>"><?php echo $cate['name']; ?></option>
            <?php  }   ?>
        </select>
        <!-- 品牌 -->
        <select name="brand_id">
            <option value="">所有品牌</option>
            <?php foreach($brand as $bran){ ?>
                <option <?php if($brand_id==$bran['id']){echo 'selected';}?> value="<?php echo $bran['id']; ?>"><?php echo $bran['name']; ?></option>
            <?php  }   ?>
        </select>
        <!-- 上架 -->
        <select name="is_on_sale">
            <option value=''>全部</option>
            <option <?php if($is_on_sale==1 && is_numeric($is_on_sale)){echo 'selected';}?> value="1">上架</option>
            <option <?php if($is_on_sale==0 && is_numeric($is_on_sale)){echo 'selected';}?>  value="0">下架</option>
        </select>
        <!-- 关键字 -->
        关键字 <input type="text" name="name" size="15" value="<?php echo $name; ?>" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>商品名称</th>
                <th>货号</th>
                <th>市场价格</th>
                <th>本店价格</th>
                <th>分类</th>
                <th>品牌</th>
                <th>供货商</th>
                <th>是否上架</th>
                <th>状态</th>
                <th>库存</th>
                <th>操作</th>
            </tr>
            <?php
                foreach($models as $goods){
            ?>
                <tr>
                    <td align="center" class="first-cell"><span><?php echo $goods['name'];?></span></td>
                    <td align="center"><span onclick=""><?php echo $goods['sn'];?></span></td>
                    <td align="center"><span><?php echo $goods['market_price'];?></span></td>
                    <td align="center"><span><?php echo $goods['shop_price'];?></span></td>
                    <td align="center"><span><?php echo $goods['category_name'];?></span></td>
                    <td align="center"><?php echo $goods['brand_name'];?></td>
                    <td align="center"><?php echo $goods['supplier_name'];?></td>
                    <td align="center"><?php if($goods['is_on_sale']==1){echo '是';}else{echo '否';} ?></td>
                    <td align="center"><?php echo $goods['status']; ?></td>
                    <td align="center"><span><?php echo $goods['store_num'];?></span></td>
                    <td align="center">
                        <a class="ajax-get refresh"  href="/trash/restore/<?php echo $goods['id']; ?>" title="添加">恢复</a></td>
                </tr>
            <?php   }  ?>
            <tr>
                <td align="right" nowrap="true" colspan="11">
                    <div id="turn-page">
                        <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</form>