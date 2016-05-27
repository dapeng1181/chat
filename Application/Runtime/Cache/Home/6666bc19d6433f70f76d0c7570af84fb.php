<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <title>堆客免费开源在线客服系统PHP版</title>
	<meta name="description" content="多用户多客服,免费开源在线客服系统PHP版">
	<meta name="author" content="dapeng - www.duiler.com">
	<meta name="keywords" content="免费,开源,客服">
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
    <div class="top">
        <div class="w1000 clearfix">
            <span class="pull-left"><i class="icon-volume-up" style="color:#38B03F"></i> 小贴士 ：本站可以免费发布广告</span>
            <span class="pull-right">快速搭建自己的WEB客服系统平台 | 拿走直接用 <i class="icon-hand-left" style="color:#EA644A"></i></span>
        </div>
    </div>
    <div class="subtop">
        <div class="w1000 clearfix">
            <div class="logo pull-left"><a href="/">Dchat <em>Alpha</em></a></div>
            <div class="bignav pull-right"><ul><li><a href="<?php echo U('Index/product');?>">产品介绍</a></li><li><a href="<?php echo U('Index/feedback');?>">问题与需求</a></li><li><a href="/index.php?s=Manage/Login/index.html" target="_blank">Alpha体验中心</a></li></ul></div>
        </div>
    </div>
</div>
<script src="/Public/dist/js/formvalid.js"></script>
<div id="contentBody" style="padding:50px;">
	<div class="alert alert-warning">
	  <div class="content">产品处于开发测试阶段，您的反馈对我们来说很重要^.^</div>
	</div>
	<form id="feedback" class="form-horizontal" role="form" method="post">
		
		<div class="form-group">
          <div class="col-xs-12">
            <label class="radio-inline input-lg"> <input type="radio" name="optionsRadios" value="1" checked> 问题反馈 </label>
            <label class="radio-inline input-lg"> <input type="radio" name="optionsRadios" value="2"> 需求反馈 </label>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <textarea name="content" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{20,500}$/" data-null="反馈内容不能为空" data-error="反馈内容长度20~500个字符"  id="content" rows="5" class="form-control input-lg" placeholder="您的反馈对我们来说很重要^.^"></textarea>
          </div>
        </div>
		<div class="form-group">
          <div class="col-xs-2">
            <input type="text" value="" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{4}$/" data-null="验证码不能为空" data-error="验证码格式错误" name="code" id="code" class="form-control input-lg" placeholder="验证码">
          </div>
		  <div class="col-xs-2">
            <img src="<?php echo U('Manage/Login/code');?>" id="imgcode" title="点击更换验证码" class="form-control input-lg"  style="padding:0;">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">
             <button class="btn btn-primary btn-lg disabled" data-loading-text="正在提交中..." id="btn-submit" type="button">提交</button>
          </div>
        </div>
    </form>
</div>
<style>
.col, .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12 {
	padding:0;
}
</style>
<script>
$("#feedback").propChange({
        imgCode:"#imgcode",
        btnSubmit:"#btn-submit",
        actionUrl:"<?php echo U('Home/Index/feedback');?>"
});
</script>
<div class="footer">
    <div class="w1000">
        <p></p>
        <p class="copyright">&copy;2016&nbsp;堆客免费开源在线客服系统PHP版 版权所有 豫ICP备15007166号-1</p>
    </div>
</div>
<script>
    $(function(){
        $("<link>").attr({ rel: "stylesheet",type: "text/css",href: "/Public/dist/css/zui-default-theme.css"}).insertAfter("#zuithumb");
    });
</script>
<script src="http://www.duiler.com/Client/Index/kefujs/sysid/97b6e749ee9553c1b93cb8fdfdf47485.html" defer async></script>
</body>
</html>