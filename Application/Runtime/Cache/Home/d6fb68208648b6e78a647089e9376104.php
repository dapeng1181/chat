<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <title>堆客免费开源在线客服系统</title>
    <link id="zuithumb" href="/Public/dist/css/zui.css" rel="stylesheet">
    <link href="/Public/dist/css/home.css" rel="stylesheet">
    <script src="/Public/dist/lib/jquery/jquery.js"></script>
    <script src="/Public/dist/js/zui.min.js"></script>
</head>
<body>
<!--[if lt IE 9]>
<div class="alert alert-danger">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
<![endif]-->
<div class="header">
    <div class="subtop">
        <div class="w1000 clearfix">
            <div class="logo pull-left"><a href="/">Dchat <em>Alpha</em></a></div>
            <div class="bignav pull-right"><ul><li><a href="<?php echo U('Index/product');?>">产品介绍</a></li><li><a href="<?php echo U('Index/feedback');?>">问题与需求</a></li><li><a href="/index.php?s=Manage/Login/index.html" target="_blank">Alpha体验中心</a></li></ul></div>
        </div>
    </div>
</div>
<iframe id="previewBox" frameborder="0" src="//<?php echo ($url); ?>"></iframe>
<style>
body{
   overflow-y: hidden;
}
#previewBox{
	position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
}
.subtop {
    margin-top: -10px;
}
</style>
<script>
    $(function(){
        $("<link>").attr({ rel: "stylesheet",type: "text/css",href: "/Public/dist/css/zui-default-theme.css"}).insertAfter("#zuithumb");
    });
</script>
<script src="http://www.duiler.com/Client/Index/kefujs/sysid/97b6e749ee9553c1b93cb8fdfdf47485.html" defer async></script>
</body>
</html>