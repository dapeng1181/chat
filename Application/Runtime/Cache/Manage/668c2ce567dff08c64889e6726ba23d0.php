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
			
                <p class="lead">
    <a class="btn btn-primary input-lg edit_kefu" data-title="新增客服" data-href="<?php echo U('Manage/Kefu/edit');?>"> + 新增客服</a>
</p>
<div class="panel">
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>昵称</th>
                <th>姓名</th>
                <th>帐号</th>
                <th>手机号</th>
                <th>权限</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["nickname"]); ?></td>
                    <td><?php echo ($vo["truename"]); ?></td>
                    <td><?php echo ($vo["account"]); ?></td>
                    <td><?php echo ($vo["mobile"]); ?></td>
                    <td>
                        <?php if($vo['auth'] == 1): ?>超级管理员<?php else: ?>客服<?php endif; ?>
                    </td>
                    <td><a class="edit_kefu" href="javascript:;" data-title="编辑客服" data-href="<?php echo U('Manage/Kefu/edit', array('uid'=>$vo['uid']));?>"><i class="icon icon-edit"></i></a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>

        <div>
             <ul class="pager pager-justify">
                 <?php echo ($page); ?>
              </ul>
        </div>
    </div>
</div>

<script>
      //面板样式js动态调整
      $(function(){
          panelHeight();
          function panelHeight(){
              var rightpanel = parseInt($(window).height())-150;
              var panel = parseInt($(".panel-body>table").height())+80;
              newpanel = rightpanel>=panel?rightpanel:panel;
              $(".panel").height(newpanel);
          };
          $(window).resize(function(){
              panelHeight();
          });
          //编辑客服
          var addKefuTrigger = {};
          $(".edit_kefu").click(function(){
              var $item = $(this);
              addKefuTrigger = new $.zui.ModalTrigger({title:$item.data("title") ,backdrop:'static',keyboard:'false',remote: $item.data("href")});
              addKefuTrigger.show();
              $item.blur();
          });
          $("body").on('hidden.zui.modal',"#triggerModal", function() {
              $(this).remove();
          });

          //分页样式
          $("body .prev").addClass("btn pull-left");
          $("body .next").addClass("btn pull-right");
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