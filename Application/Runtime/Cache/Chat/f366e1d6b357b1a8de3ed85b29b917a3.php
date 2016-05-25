<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>在线客服端</title>
    <link id="zuithumb" href="/Public/dist/css/zui.css" rel="stylesheet">
    <link href="/Public/dist/css/common.css" rel="stylesheet">
    <script src="/Public/dist/lib/jquery/jquery.js"></script>
    <script src="/Public/dist/js/zui.min.js"></script>
    <script src="/Public/dist/lib/cookie/jquery.cookie.js"></script>
    <script src="/Public/dist/lib/common/json.js"></script>
    <script src="/Public/dist/js/formvalid.js"></script>
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
            <?php if($auth == 1): ?><li><a id="switchKf" href="<?php echo U('Manage/Index/index');?>"><i class="icon icon-exchange"></i> 切换为管理模式</a></li><?php endif; ?>
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
                    <a href="<?php echo U('Chat/Index/index');?>" class="list-group-item <?php if((CONTROLLER_NAME) == "Index"): ?>active<?php endif; ?>"><i class="icon-chat"></i> 当前会话</a>
                    <a href="<?php echo U('Chat/History/index');?>" class="list-group-item <?php if((CONTROLLER_NAME) == "History"): ?>active<?php endif; ?>"><i class="icon-history"></i> 历史会话</a>
                    <a href="<?php echo U('Chat/Setting/index');?>" class="list-group-item <?php if((CONTROLLER_NAME) == "Setting"): ?>active<?php endif; ?>"><i class="icon-cog"></i> 设置</a>
                    <a href="http://chat.duiler.com/index.php/Client/Index/index/sysid/97b6e749ee9553c1b93cb8fdfdf47485.html" target="_blank" class="list-group-item"><i class="icon-comments-alt"></i> 联系我们</a>
                </div>
            </div>
        </div>
        <div class="col-xs-10 rightcon">
            <div class="rightpanel">
			
                
<div class="panel">
    <div class="panel-heading">
        个人信息
    </div>
    <div class="panel-body">
        <form class="kfaccountform form-horizontal">
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
        密码设置
    </div>
    <div class="panel-body">
        <form class="kfaccountform form-horizontal">
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
        //个人信息 密码修改
        $(".kfaccountform").propChange({
            btnSubmit:".submitBtn",
            actionUrl:"<?php echo U('Chat/Setting/save');?>",
            fromRefresh:true
        });
    });
</script>
<script>
    //客服信息变量
    var msg = {},
            ws = {},
            uid = <?php echo ($uid); ?>,  //身份uid
            role = "worker",  //客服人员
            relation = "<?php echo ($companyid); ?>", //所属系统标识
            visitid = "";  //当前聊天的访客标识
</script>
<script>
    $(function(){
        sk_init();
        function sk_init() {
            ws = new WebSocket("ws://localhost:8585");
            ws.onopen = function () {
                msg = {};
                msg.type = "login"; //消息类型
                msg.uid = uid; //访客标识id
                msg.role = role; //访客身份
                msg.relation = relation; //所属客服系统
                ws.send(JSON.stringify(msg));
            };
        }
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
        //点击切换客服页面提醒
        $("#switchKf").click(function(e){
            confirm("确定要离开当前页面？") || e.preventDefault();
        });

    });
</script>
</body>
</html>