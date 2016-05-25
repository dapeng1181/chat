<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>在线客服登录</title>
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
                        <form class="form-horizontal" id="loginform">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <h1 class="text-center text-primary"> 管理登录 </h1>
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
                                           <a href="javascript:;">忘记密码？</a>
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
    });
</script>
</body>
</html>