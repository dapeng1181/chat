<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <title>在线客服登录</title>
    <link href="/Public/dist/css/zui.css" rel="stylesheet">
    <link href="/Public/dist/css/zui-default-theme.css" rel="stylesheet">
    <link href="/Public/dist/css/common.css" rel="stylesheet">
    <script src="/Public/dist/lib/jquery/jquery.js"></script>
    <script src="/Public/dist/js/zui.min.js"></script>
    <script src="/Public/dist/lib/cookie/jquery.cookie.js"></script>
    <script src="/Public/dist/js/formvalid.js"></script>
    <script src="/Public/dist/js/particles.min.js"></script>
    <style>
        body {
            background: #60d4d4;
            font: normal 14px/1.6 "Helvetica neue", "Segoe UI", Arial, "Microsoft Jhenghei", "Microsoft Yahei", Sans-serif;
        }
        .formpanel{
            width: 420px;
            margin:0 auto;
            margin-top:60px;
        }
        .formpanel .form-group {
            padding: 30px 0;
        }
        .formpanel .panel {
            border: none;
        }
        #particles-js{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .panel{
            background: none;
        }
        .text-t, label, label a, p, p a{
            color:#fff;
        }
        .text-t{
           font-size: 54px;
        }
        label a:hover, p a:hover{
            color:#fff;
        }
		.popover-content{
			color:#758392;
		}
    </style>
</head>
<body>
<!--[if lt IE 8]>
<div class="alert alert-danger">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
<![endif]-->
<div id="particles-js"></div>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="formpanel">
                <div class="panel">
                    <div class="panel-body">
                        <form class="form-horizontal" id="loginform">
                            <div class="form-group" style="padding-bottom: 80px;text-align: center;">
                                <div class="col-xs-12">
                                    <span class="text-center text-t"> 管理登录 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="text"  data-fic="fic" data-type="/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/" data-null="账号不能为空" data-error="账号格式错误" name="account" id="account"  placeholder="登录帐号" class="form-control input-lg">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="password" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,16}$/" data-null="密码不能为空" data-error="密码格式错误" name="password" id="password" placeholder="登录密码 6-16个字符" class="form-control input-lg">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <div class="checkbox">
                                        <label style="width:100%">
                                            无账号？<a href="<?php echo U('Manage/Login/reg');?>">去注册</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="checkbox pull-right">
                                        <label>
                                           <a href="javascript:;" id="logpass" data-toggle="popover" data-placement="right" data-content="忘记密码请联系企业超级管理员重置密码；超级管理员忘记密码请联系1528065095@qq.com">忘记密码？</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="padding-top: 0;">
                                <div class="col-xs-12">
                                    <button id="btn-submit" class="btn btn-primary btn-block btn-lg disabled" data-loading-text="正在登录中..."> 立即登录 </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#loginform").propChange({
            btnSubmit:"#btn-submit",
            actionUrl:"<?php echo U('Manage/Login/index');?>"
        });
		$('#logpass').hover(function(){
			$(this).popover('show');
		},function(){
			$(this).popover('hide');
		});
    });
    particlesJS.load('particles-js', '/Public/dist/js/particles.json', function() {
      console.log('callback - particles.js config loaded');
    });
</script>
</body>
</html>