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
                    <a href="#" class="list-group-item"><i class="icon-comments-alt"></i> 联系我们</a>
                </div>
            </div>
        </div>
        <div class="col-xs-10 rightcon">
            <div class="rightpanel">
			
                <div class="navdiv">
    <ul class="nav nav-secondary nav-justified">
        <li class="">
            <a href="<?php echo U('Manage/Setting/index');?>">基础设置 </a>
        </li>
        <li class="active">
            <a href="<?php echo U('Manage/Setting/pc');?>">网站接入 </a>
        </li>
        <li class="">
            <a href="javascript:alert('该功能正在开发完善中...')">会话设置 </a>
        </li>
    </ul>
</div>
<div class="panel">
    <div class="panel-heading">
        接入代码
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-5">
        <p><strong>1.在网站中嵌入代码</strong></p>
        <p style="color:#808080">请将以下代码添加到你网站的 HTML 源代码中，放在&lt;/body>标签之前</p>
        <p><textarea class="script-textarea form-control" rows="3" readonly="readonly" style="resize:none;cursor:text;background-color: #fff;"><script src="<?php echo ($js_url); ?>" defer async></script>
        </textarea></p>
        <p><button  class="btn-clip btn btn-primary input-lg" data-clip="script-textarea"  data-loading-text="<i class='icon-check'></i>已成功复制到剪切板" type="button"> 复制到剪切板 </button></p>
        <p style="color:#808080">或 直接使用以下链接</p>
        <p><textarea class="url-textarea form-control" rows="3" readonly="readonly" style="resize:none;cursor:text;background-color: #fff;"><?php echo ($http_url); ?>
</textarea></p>
        <p><button  class="btn-clip btn btn-primary input-lg" data-clip="url-textarea"  data-loading-text="<i class='icon-check'></i>已成功复制到剪切板" type="button"> 复制到剪切板 </button></p>
         <br/>

        </div>
            <div class="col-xs-7"></div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-heading">
        访客端设置
    </div>
    <div class="panel-body">
        <form class="terminalform form-horizontal">
            <input type="hidden" name="attr" value="company">
            <div class="row">
                <div class="col-xs-5">
                    <p><strong>1.  选择访客端颜色</strong></p>
                    <div class="panel">
                        <div class="panel-body">
                            <span class="terminal-theme theme-black" data-style="black"><?php if(($company['style']) == "black"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-bluegrey" data-style="bluegrey"><?php if(($company['style']) == "bluegrey"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-indigo" data-style="indigo"><?php if(($company['style']) == "indigo"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-yellow" data-style="yellow"><?php if(($company['style']) == "yellow"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-brown" data-style="brown"><?php if(($company['style']) == "brown"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-purple" data-style="purple"><?php if(($company['style']) == "purple"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-green" data-style="green"><?php if(($company['style']) == "green"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-red" data-style="red"><?php if(($company['style']) == "red"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-blue" data-style="blue"><?php if(($company['style']) == "blue"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                            <span class="terminal-theme theme-default" data-style="default"><?php if(($company['style']) == "default"): ?><i class="icon-check"></i><?php else: ?>&nbsp;<?php endif; ?></span>
                        </div>
                        <input type="hidden" name="style" value="<?php echo ($company["style"]); ?>"/>
                    </div>
                    <p><strong>2.  访客端入口文案</strong></p>
                    <p><input class="form-control input-lg" type="text" name="title" value="<?php echo ($company["title"]); ?>"></p>
                    <p><strong>3.  客服欢迎语</strong></p>
                    <p><textarea class="form-control" name="welcome" rows="2"><?php echo ($company["welcome"]); ?></textarea></p>
                    <p><strong>2.客服系统开关</strong></p>
                    <p>
                    <div class="btn-group">
                        <label class="btn input-lg btn-switch <?php if(($company['status']) == "3"): ?>btn-primary<?php endif; ?>" data-status="1">
                            启用
                        </label>
                        <label class="btn input-lg btn-default btn-switch <?php if(($company['status']) != "3"): ?>active<?php endif; ?>" data-status="0">
                           停用
                        </label>
                    </div>
                    <input type="hidden" name="status" value="<?php if(($company['status']) == "3"): ?>1<?php else: ?>0<?php endif; ?>">
                    </p>
                    <p style="color:#808080">开启后,客服系统才能正常使用</p>
                    <p><button class="btn btn-lg btn-primary submitBtn disabled" data-loading-text="正在提交中..."> 保存 </button></p>
                </div>
                <div class="col-xs-7"></div>
            </div>
        </form>
    </div>
</div>

<script>
$(function(){
    //点击复制
    var client = new ZeroClipboard($(".btn-clip"));
    client.on( 'ready', function(event) {
        client.on( 'copy', function(event) {
            if(!$(event.target).is(".disabled")){
                event.clipboardData.setData('text/plain', $.trim($("."+$(event.target).data("clip")).text()));
                $(event.target).button('loading');
                setTimeout(function() {
                    $(event.target).button('reset');
                }, 1000);
            }
        });
    } );
    // 访客端颜色选择
    $(".terminal-theme").click(function(){
        $ter_item = $(this);
        $ter_item.siblings().html("&nbsp;").end().html("<i class=\"icon-check\"></i>");
        $("input[name='style']").val($ter_item.data("style"));
        $(".terminalform").formIsComplete();
    });
    //客服系统开关
    $(".btn-switch").click(function(){
        $switch_item = $(this);
        if($switch_item.data("status")==1){
            $switch_item.siblings().removeClass("active").end().addClass("btn-primary");
        }else{
            $switch_item.siblings().removeClass("btn-primary").end().addClass("active");
        }
        $("input[name='status']").val($switch_item.data("status"));
        $(".terminalform").formIsComplete();
    });

    //表单提交
    $(".terminalform").propChange({
        btnSubmit:".submitBtn",
        actionUrl:"<?php echo U('Manage/Setting/save');?>"
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