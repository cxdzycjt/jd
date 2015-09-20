<link  type="text/css" href="/css/zTreeStyle/zTreeStyle.css" rel="stylesheet">
<script type="text/javascript" src="/js/jquery.ztree.core-3.5.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor1_4_3/ueditor.all.min.js"></script>
<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
            <span class="tab-back" id="intro-tab">详细描述</span>
            <span class="tab-back" id="memeber-price-tab">会员价格</span>
            <span class="tab-back" id="attributes-tab">商品属性</span>
            <span class="tab-back" id="galery-tab">商品相册</span>
            <span class="tab-back" id="news-tab">关联新闻</span>
        </p>
    </div>
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="/goods/edit" method="post">
            <table width="90%" class="form-table" id="general-table" align="center">
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="name" value="<?php echo $commonData['name']; ?>"size="30" />
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品图片</td>
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
                    <td class="label">商品分类：</td>
                    <td>
                        <input type="text" placeholder="不选择默认为顶级分类下" name="category_text" disabled id="category_text" maxlength="60" value="<?php echo $commonData['category_id']; ?>"/>
                        <input type="hidden" name="category_id" id="category_id" value="<?php if(!empty($commonData['category_id'])){echo $commonData['category_id']; }else{echo 1;} ?>"/>
                        <!--生成树状结构的代码-->
                        <ul id="tree" class="ztree"></ul>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id">
                            <option value="0">请选择...</option>
                            <?php
                            foreach($brand as $barn){
                                ?>
                                <option <?php if($barn['id']==$commonData['supplier_id']){echo 'selected';}  ?> value="<?php echo $barn['id']; ?>"><?php echo $barn['name']; ?></option>
                            <?php  }  ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">供应商：</td>
                    <td>
                        <select name="supplier_id">
                            <option value="0">请选择...</option>
                            <?php
                            foreach($supplier as $suppli){
                                ?>
                                <option <?php if($suppli['id']==$commonData['supplier_id']){echo 'selected';}  ?> value="<?php echo $suppli['id']; ?>"><?php echo $suppli['name']; ?></option>
                            <?php  }  ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php if(!empty($commonData['market_price'])){echo $commonData['market_price'];}else{echo 0;} ?>" size="20" />
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php if(!empty($commonData['shop_price'])){echo $commonData['shop_price'];}else{echo 0;} ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">库存类型：</td>
                    <td>
                        <input type="radio" name="store_type" value="1"/> 单品
                        <input type="radio" name="store_type" value="0"/> 多品(多属性统计)
                    </td>
                </tr>
                <tr>
                    <td class="label">商品数量：</td>
                    <td>
                        <input type="text" name="store_num" size="20" value="<?php if(!empty($commonData['store_num'])){echo $commonData['store_num'];}else{echo 0;} ?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_on_sale" value="1"/> 是
                        <input type="radio" name="is_on_sale" value="0"/> 否
                    </td>
                </tr>
                <!--<tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_best" value="1" /> 精品
                        <input type="checkbox" name="is_new" value="1" /> 新品
                        <input type="checkbox" name="is_hot" value="1" /> 热销
                    </td>
                </tr>-->
            </table>
            <table cellspacing="1" cellpadding="3" width="100%" style="display: none" class="form-table">
                <tr>
                    <td><textarea name="intro" id="intro"><?php echo $commonData['intro']; ?></textarea></td>
                </tr>
            </table>

            <table style="display: none" class="form-table" width="90%" id="general-table" align="center">
                <?php foreach($rank as $ran){   ?>
                <tr>
                    <td class="label"><?php echo $ran['name']; ?>：</td>
                    <td><input type="text" name="numberPrice[<?php echo $ran['id']?>]"/></td>
                </tr>
                <?php  }  ?>

            </table>
            <table style="display: none" class="form-table" width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">属性：</td>
                </tr>

            </table>
            <table style="display: none" class="form-table" width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">相册：</td>
                </tr>

            </table>
            <table style="display: none" class="form-table" width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">新闻：</td>
                </tr>
            </table>
            <div class="button-div">
                <input type="hidden" name="id" value="<?php echo $commonData['id']; ?>"/>
                <input type="button" class="button ajax-post" value=" 确定 " />
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $(":radio[name='is_on_sale']").val([<?php if(!empty($commonData['is_on_sale'])){echo $commonData['is_on_sale'];}else{echo 1;} ?>]);
        $(":radio[name='store_type']").val([<?php if(!empty($commonData['store_type'])){echo $commonData['store_type'];}else{echo 1;} ?>]);
        /**商品页面切换**/
        $('#tabbar-div span').click(function(){
            $('#tabbar-div span').removeClass('tab-front').addClass('tab-back');
            $(this).removeClass('tab-back').addClass('tab-front');
            var index = $(this).index();      //获取被点击的索引
            var tables = $("#tabbody-div .form-table");
            tables.hide();
            tables.eq(index).show();
            /***********************在线编辑器开始************************************/
            if(index==1){
                UE.getEditor('intro',{
                    initialFrameWidth:'100%',  //初始化编辑器宽度,默认1000
                    initialFrameHeight:320
                });
            }
            /***********************在线编辑器结束************************************/
        });
        /**商品页面切换**/
        /*图片上传*/
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
        /*分类展示*/
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
                    $('#category_text').val(treeNode.name);
                    $('#category_id').val(treeNode.id);           //将选中的节点id作为父分类的id
                },
                'beforeClick': function(treeId, treeNode, clickFlag){
                    if(treeNode.isParent){ //有儿子时有错误提示..
                        var data = {message:'只能够选择最小分类'};
                        updateAlert(data);
                    }
                    return !treeNode.isParent;
                }
            }
        };
        var zNodes = <?php echo $tree; ?>;          //取出php给页面分配的json数据
        var treeObj =$.fn.zTree.init($("#tree"), setting, zNodes);
        //treeObj.expandAll(true);            //展开
        var category_id = <?php echo  $commonData['category_id']?$commonData['category_id']:"''"; ?>;
        if(category_id != ''){
            var goodsCategoryNode= treeObj.getNodeByParam('id',<?php echo  $commonData['category_id']?$commonData['category_id']:"''"; ?>); //根据id(该id是数据库中的)找到指定的节点..
            treeObj.selectNode(goodsCategoryNode); //选中找到的节点
            $("#category_text").val(goodsCategoryNode.name);
        }else{
        }
    })
</script>