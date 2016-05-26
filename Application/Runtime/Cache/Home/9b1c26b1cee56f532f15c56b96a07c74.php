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
    <div class="top">
        <div class="w1000 clearfix">
            <span class="pull-left"><i class="icon-volume-up" style="color:#38B03F"></i> 小贴士 ：本站可以免费发布广告</span>
            <span class="pull-right">快速搭建自己的WEB客服系统平台 | 拿走直接用 <i class="icon-hand-left" style="color:#EA644A"></i></span>
        </div>
    </div>
    <div class="subtop">
        <div class="w1000 clearfix">
            <div class="logo pull-left"><a href="/">Dchat <em>Alpha</em></a></div>
            <div class="bignav pull-right"><ul><li><a href="">产品介绍</a></li><li><a href="">开源博客</a></li><li><a href="">问题与需求</a></li><li><a href="/index.php?s=Manage/Login/index.html" target="_blank">Alpha体验中心</a></li></ul></div>
        </div>
    </div>
</div>
<script src="/Public/dist/js/particles.min.js"></script>
<style>
#particles-js{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
</style>
<div id="exper">
<div id="particles-js"></div>
<div class="tititle">输入你的网址，点击立即体验</div>
<div class="input-group">
    <span class="input-group-addon btn-lg">http://</span>
  <input type="text" class="form-control input-lg tiyan-url" placeholder="请输入你的网址">
  <span class="input-group-btn">
    <button class="btn btn-primary btn-lg tiyan" type="button">立即体验</button>
  </span>
</div>
</div>
<script>
	
    particlesJS.load('particles-js', '/Public/dist/js/particlesindex.json', function() {
      console.log('callback - particles.js config loaded');
    });
	
	var preview_url = '/index.php?s=Home/Index/preview/url/';
	$(".tiyan").on("click",function(){
	     var tiyan_url = $(".tiyan-url").val();
		if(!!$(".tiyan-url").val()){
			window.open(preview_url+tiyan_url);
		}
	});
</script>
<div class="footer">
    <div class="w1000">
        <p></p>
        <p class="copyright">&copy;2016&nbsp;堆客免费开源在线客服系统 版权所有 豫ICP备15007166号-1</p>
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