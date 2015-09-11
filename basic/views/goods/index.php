<div class="form-div">
    <form action="" name="searchForm">
        <img src="/img/icon_search.gif" width="26" height="22" border="0" alt="search" />
        <!-- 分类 -->
        <select name="cat_id">
            <option value="0">所有分类</option>
            <foreach name="cat_list" item="val">
                <option value="<{$val.cat_id}>"><{$val.lev|str_repeat='&nbsp;&nbsp;',###}><{$val.cat_name}></option>
            </foreach>
        </select>
        <!-- 品牌 -->
        <select name="brand_id">
            <option value="0">所有品牌</option>
            <foreach name="brand_list" item="val">
                <option value="<{$val.brand_id}>"><{$val.brand_name}></option>
            </foreach>
        </select>
        <!-- 推荐 -->
        <select name="intro_type">
            <option value="0">全部</option>
            <option value="is_best">精品</option>
            <option value="is_new">新品</option>
            <option value="is_hot">热销</option>
        </select>
        <!-- 上架 -->
        <select name="is_on_sale">
            <option value=''>全部</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
        </select>
        <!-- 关键字 -->
        关键字 <input type="text" name="keyword" size="15" />
        <input type="submit" value=" 搜索 " class="button" />
    </form>
</div>

<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="">
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>编号</th>
                <th>商品名称</th>
                <th>货号</th>
                <th>价格</th>
                <th>上架</th>
                <th>精品</th>
                <th>新品</th>
                <th>热销</th>
                <th>推荐排序</th>
                <th>库存</th>
                <th>操作</th>
            </tr>
            <foreach name="list" item="val">
                <tr>
                    <td align="center"><{$val.goods_id}></td>
                    <td align="center" class="first-cell"><span><{$val.goods_name}></span></td>
                    <td align="center"><span onclick=""><{$val.goods_sn}></span></td>
                    <td align="center"><span><{$val.shop_price}></span></td>
                    <td align="center"><img src=""/></td>
                    <td align="center"><img src=""/></td>
                    <td align="center"><img src=""/></td>
                    <td align="center"><img src=""/></td>
                    <td align="center"><span>100</span></td>
                    <td align="center"><span><{$val.goods_number}></span></td>
                    <td align="center">
                        <a href="__APP__/Goods/?goods_id=<{$val.goods_id}>" target="_blank" title="查看"><img src="/img/icon_view.gif" width="16" height="16" border="0" /></a>
                        <a href="__GROUP__/Goods/goodsEdit?goods_id=<{$val.goods_id}>" title="编辑"><img src="/img/icon_edit.gif" width="16" height="16" border="0" /></a>
                        <a href="__GROUP__/Goods/goodsTrash?goods_id=<{$val.goods_id}>" onclick="" title="回收站"><img src="/img/icon_trash.gif" width="16" height="16" border="0" /></a></td>
                </tr>
            </foreach>
        </table>

        <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <{$showPage}>
                </td>
            </tr>
        </table>
        <!-- 分页结束 -->
    </div>
</form>