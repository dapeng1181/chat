<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>在线客服注册</title>
    <link href="/Public/dist/css/zui.css" rel="stylesheet">
    <link href="/Public/dist/css/zui-default-theme.css" rel="stylesheet">
    <link href="/Public/dist/css/common.css" rel="stylesheet">
    <script src="/Public/dist/lib/jquery/jquery.js"></script>
    <script src="/Public/dist/js/zui.min.js"></script>
    <script src="/Public/dist/lib/cookie/jquery.cookie.js"></script>
    <script src="/Public/dist/js/formvalid.js"></script>
    <script src="/Public/dist/js/formPlaceholder.js"></script>
    <!--[if lt IE 9]>
    <script src="/Public/dist/lib/ieonly/html5shiv.js"></script>
    <script src="/Public/dist/lib/ieonly/respond.js"></script>
    <script src="/Public/dist/lib/ieonly/excanvas.js"></script>
    <![endif]-->
    <style>
        body {
            background-color: #ffffff;
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
        #imgcode{
            padding:0;
            cursor: pointer;
        }
    </style>
</head>
<body>
<!--[if lt IE 8]>
<div class="alert alert-danger">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
<![endif]-->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="formpanel">
                <div class="panel">
                    <div class="panel-body">
                        <form id="regform" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <h1 class="text-center text-primary">免费注册</h1>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="text" data-fic="fic" data-type="/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/" data-null="邮箱/账号不能为空" data-error="邮箱格式错误" name="account" id="account"  placeholder="请输入邮箱 默认为超级管理员帐号" value="" class="form-control input-lg">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input type="password" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,16}$/" data-null="密码不能为空" data-error="密码格式错误" name="password" id="password"  placeholder="请输入密码 6到16位字符" value="" class="form-control input-lg">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <input type="text" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{4}$/" data-null="验证码不能为空" data-error="验证码格式错误" name="code" id="code"  placeholder="请输入验证码" value="" class="form-control input-lg">
                                </div>
                                <div class="col-xs-6">
                                    <img src="<?php echo U('Manage/Login/code');?>" id="imgcode" title="点击更换验证码" class="form-control input-lg">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="checkbox">
                                        <label style="width:100%">
                                            已注册？<a href="<?php echo U('Manage/Login/index');?>">去登录</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="padding-top: 0;">
                                <div class="col-xs-12">
                                    <button id="btn-submit" class="btn btn-primary btn-block btn-lg disabled" data-loading-text="正在注册中..."> 立即注册 </button>
                                </div>
                            </div>
                            <div class="form-group" style="padding-top: 5px;">
                                <div class="col-xs-12">
                                    <p class="text-center">点击注册，表示你同意并愿意遵守<a href="#">《服务条款》</a></p>
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
    $("#regform").propChange({
        imgCode:"#imgcode",
        btnSubmit:"#btn-submit",
        actionUrl:"<?php echo U('Manage/Login/reg');?>"
    });
});
</script>
</body>
</html>