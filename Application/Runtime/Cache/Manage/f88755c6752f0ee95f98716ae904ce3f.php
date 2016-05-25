<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>在线客服管理端</title>
    <link id="zuithumb" href="/Public/dist/css/zui.css" rel="stylesheet">
    <link href="/Public/dist/css/common.css" rel="stylesheet">
    <script src="/Public/dist/lib/jquery/jquery.js"></script>
    <script src="/Public/dist/js/zui.min.js"></script>
    <script src="/Public/dist/lib/cookie/jquery.cookie.js"></script>
    <script src="/Public/dist/lib/common/json.js"></script>
    <script src="/Public/dist/js/formvalid.js"></script>
    <script src="/Public/dist/lib/ZeroClipboard/ZeroClipboard.min.js"></script>
</head>
<body>
<!--[if lt IE 9]>
<div class="alert alert-danger">您正在使用 <strong>过时的</strong> 浏览器. 是时候 <a href="http://browsehappy.com/">更换一个更好的浏览器</a> 来提升用户体验.</div>
<![endif]-->

<nav class="navbar navbar-default header" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="javascript:;"><i class="icon icon-chat-dot"></i> 在线客服</a>
    </div>
    <div class="collapse navbar-collapse navbar-collapse-example">
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-primary">&nbsp;</span> 换肤 <b class="caret"></b></a>
                <ul class="dropdown-menu themelist" role="menu">
                    <li><span class="label theme-black" data-t="black">&nbsp;</span></li>
                    <li><span class="label theme-bluegrey" data-t="bluegrey">&nbsp;</span></li>
                    <li><span class="label theme-indigo" data-t="indigo">&nbsp;</span></li>
                    <li><span class="label theme-yellow" data-t="yellow">&nbsp;</span></li>
                    <li><span class="label theme-brown" data-t="brown">&nbsp;</span></li>
                    <li><span class="label theme-purple" data-t="purple">&nbsp;</span></li>
                    <li><span class="label theme-green" data-t="green">&nbsp;</span></li>
                    <li><span class="label theme-red" data-t="red">&nbsp;</span></li>
                    <li><span class="label theme-blue" data-t="blue">&nbsp;</span></li>
                    <li><span class="label theme-default" data-t="default">&nbsp;</span></li>
                </ul>
            </li>
            <li><a href="http://www.duiler.com" target="_blank"><i class="icon icon-lightbulb"></i> 了解</a></li>
            <li><a href="<?php echo U('Chat/Index/index');?>"><i class="icon icon-exchange"></i> 切换为客服模式</a></li>
            <li><a><?php echo ($account); ?></a></li>
            <li><a href="<?php echo U('Manage/Login/loginout');?>">退出 <i class="icon icon-signout"></i></a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-xs-2 leftcon">
            <div class="leftpanel">
                <div class="list-group">
                    <a href="<?php echo U('Manage/Index/index');?>" class="list-group-item <?php if((CONTROLLER_NAME) == "Index"): ?>active<?php endif; ?>"><i class="icon-home"></i> 主页</a>
                    <a href="<?php echo U('Manage/History/index');?>" class="list-group-item <?php if((CONTROLLER_NAME) == "History"): ?>active<?php endif; ?>"><i class="icon-history"></i> 历史会话</a>
                    <a href="<?php echo U('Manage/Kefu/index');?>" class="list-group-item <?php if((CONTROLLER_NAME) == "Kefu"): ?>active<?php endif; ?>"><i class="icon-group"></i> 客服管理</a>
                    <a href="<?php echo U('Manage/Setting/index');?>" class="list-group-item <?php if((CONTROLLER_NAME) == "Setting"): ?>active<?php endif; ?>"><i class="icon-cog"></i> 设置</a>
                    <a href="http://chat.duiler.com/index.php/Client/Index/index/sysid/97b6e749ee9553c1b93cb8fdfdf47485.html" target="_blank" class="list-group-item"><i class="icon-comments-alt"></i> 联系我们</a>
                </div>
            </div>
        </div>
        <div class="col-xs-10 rightcon">
            <div class="rightpanel">
			
                <div class="navdiv">
    <ul class="nav nav-secondary nav-justified">
        <li class="active">
            <a href="<?php echo U('Manage/Setting/index');?>">基础设置 </a>
        </li>
        <li class="">
            <a href="<?php echo U('Manage/Setting/pc');?>">网站接入 </a>
        </li>
        <li class="">
            <a href="javascript:alert('该功能正在开发完善中...')">会话设置 </a>
        </li>
    </ul>
</div>
<div class="panel">
    <div class="panel-heading">
        个人信息
    </div>
    <div class="panel-body">
        <form class="accountform form-horizontal">
            <input type="hidden" name="attr" value="account">
            <div class="form-group">
                <label class="col-xs-1 control-label">账户</label>

                <div class="col-xs-4" style="padding-top: 6px;">
                    <?php echo ($user["account"]); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">姓名</label>

                <div class="col-xs-4">
                    <input type="text" name="truename" id="truename" value="<?php echo ($user["truename"]); ?>" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">昵称</label>

                <div class="col-xs-4">
                    <input type="text" name="nickname" id="nickname" value="<?php echo ($user["nickname"]); ?>" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">手机</label>

                <div class="col-xs-4">
                    <input type="text" name="mobile" id="mobile" value="<?php echo ($user["mobile"]); ?>" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">邮箱</label>

                <div class="col-xs-4">
                    <input type="text" name="email" id="email" value="<?php echo ($user["email"]); ?>" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label"></label>

                <div class="col-xs-4">
                    <button class="btn btn-primary submitBtn input-lg disabled" data-loading-text="正在提交中..."> 保存</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel">
    <div class="panel-heading">
        公司信息
    </div>
    <div class="panel-body">
        <div class="alert alert-warning with-icon">
            <div class="content">请如实填写以下信息，它将作为我们向您提供服务的重要依据，我们会对您的资料严格保密。</div>
        </div>
        <form class="accountform form-horizontal">
            <input type="hidden" name="attr" value="company">
            <div class="form-group">
                <label class="col-xs-1 control-label">公司名称</label>
                <div class="col-xs-4">
                    <input type="text" name="company" id="company" value="<?php echo ($company["company"]); ?>" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">公司官网</label>
                <div class="col-xs-4">
                    <input type="text" name="website" id="website" value="<?php echo ($company["website"]); ?>" placeholder="不必填写 “http://” 开头" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">联系人姓名</label>
                <div class="col-xs-4">
                    <input type="text" name="linkman" id="linkman" value="<?php echo ($company["linkman"]); ?>" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">联系人电话</label>
                <div class="col-xs-4">
                    <input type="text" name="telephone" id="telephone" value="<?php echo ($company["telephone"]); ?>" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">详细地址</label>
                <div class="col-xs-4">
                    <textarea class="form-control" rows="2" name="address" placeholder="请填写详细街道地址，方便邮寄发票及礼品"><?php echo ($company["address"]); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label"></label>
                <div class="col-xs-4">
                    <button class="btn btn-primary submitBtn input-lg disabled" data-loading-text="正在提交中..."> 保存 </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel">
    <div class="panel-heading">
        密码设置
    </div>
    <div class="panel-body">
        <form class="accountform form-horizontal">
            <input type="hidden" name="attr" value="pass">
            <div class="form-group">
                <label class="col-xs-1 control-label">原密码</label>

                <div class="col-xs-4">
                    <input type="password" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,16}$/" data-null="密码不能为空" data-error="密码格式错误" name="password" id="password" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">新密码</label>

                <div class="col-xs-4">
                    <input type="password" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,16}$/" data-null="新密码不能为空" data-error="密码格式错误" name="newpassword" id="newpassword" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label">确认新密码</label>

                <div class="col-xs-4">
                    <input type="password" data-fic="fic" data-error="两次输入的密码不一致" data-recheck="newpassword" name="repassword" id="repassword" class="form-control input-lg">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-1 control-label"></label>

                <div class="col-xs-4">
                    <button class="btn btn-primary submitBtn input-lg disabled" data-loading-text="正在提交中..."> 保存</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(function(){
        //密码修改
        $(".accountform").propChange({
            btnSubmit:".submitBtn",
            actionUrl:"<?php echo U('Manage/Setting/save');?>",
            fromRefresh:true
        });
    });
</script>

            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        //默认主题引入
        var $themename = !!$.cookie("themename")?$.cookie("themename"):"default";
        $("<link>").attr({ rel: "stylesheet",type: "text/css",href: "/Public/dist/css/zui-"+$themename+"-theme.css"}).insertAfter("#zuithumb");
        //主题颜色切换
        $(".themelist").on("click","span",function(){
            $.cookie("themename",$(this).data("t"),{expires:7, path:'/'});
            window.location.reload(true);
        });
    });
</script>
</body>
</html>