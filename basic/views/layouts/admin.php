<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - <?php echo $this->params['layoutData']?> </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/general.css" rel="stylesheet" type="text/css" />
    <link href="/css/main.css" rel="stylesheet" type="text/css" />
    <link href="/css/page.css" rel="stylesheet" type="text/css" />
    <link href="/css/common.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js" ></script>
    <script type="text/javascript" src="/js/common.js" ></script>
    <script type="text/javascript" src="/uploadify/jquery.uploadify.min.js" ></script>
    <link  type="text/css" href="/css/zTreeStyle/zTreeStyle.css" rel="stylesheet">
    <style type="text/css">
        .ztree{
            background-color: gainsboro;
            width: 200px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
<h1>
    <span class="action-span"><a href="/<?php echo $this->params['controller']?>/<?php echo $this->params['action']?>"><?php echo $this->params['layoutData']?></a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 品牌管理</span>
    <div style="clear:both"></div>
</h1>
<!--提示框-->
<div id="top-alert" class="fixed alert" style="display: none;">
    <button class="close fixed" style="margin-top: 4px;">×</button>
    <div class="alert-content">这是内容</div>
</div>

<?php echo $content; ?>

<div id="footer">
    共执行 3 个查询，用时 0.021251 秒，Gzip 已禁用，内存占用 2.194 MB<br />
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>