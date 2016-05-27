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
<div id="contentBody" style="padding: 50px 0;font-size: 16px;">
	
	<p>
		本着物尽所用，人尽其能，完全开源开放共享的原则
	</p>
	<p>
		页面UI框架：ZUI&nbsp;<a target="_blank" href="http://zui.sexy/">http://zui.sexy/</a>
	</p>
	<p>
		程序开发：ThinkPHP框架&nbsp;<a href="http://www.thinkphp.cn/" target="_blank">http://www.thinkphp.cn/</a>
	</p>
	<p>
		服务端socket开发：GatewayWorker框架&nbsp;<a target="_blank" href="http://www.workerman.net/">http://www.workerman.net/</a>
	</p>
	<p>
		浏览器端采用websocket协议
	</p>
	<p>
		服务器：阿里云ECS linux+nginx+mysql+php &nbsp;<a href="https://www.aliyun.com" target="_blank">https://www.aliyun.com</a>
	</p>
	<p>
		数据库：mysql
	</p>
	<p>
		实例代码：
	</p>
	<div style="color:#38b03f;font-size:18px;font-style: italic;">
		<p>
			Client:
		</p>
		<p>
			&lt;script&gt;<br/>
		</p>
		<p>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ws.send(JSON.stringify({&quot;type&quot;:&quot;text&quot;,&quot;msg&quot;:&quot;你好&quot;}));&nbsp;&nbsp;<br/>
		</p>
		<p>
			&lt;/script&gt;
		</p>
		<p>
			Server:
		</p>
		<p>
			&lt;?php
		</p>
		<p>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gateway::sendToUid($client_id, json_encode(array(&quot;type&quot;=&gt;&quot;text&quot;,&quot;msg&quot;=&gt;&quot;你好&quot;)));
		</p>
		<p>
			?&gt;<br/>
		</p>
	</div>
	<p>
		开发人员：dapeng，冰冻的狐狸
	</p>
	<p>
		github地址：<a href="https://github.com/dapeng1181/chat" target="_blank">https://github.com/dapeng1181/chat</a>
	</p>
</div>
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