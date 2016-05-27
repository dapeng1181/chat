/**
 * Created by zhangyanpo on 2016/4/7.
 */
$(function(){
    sk_init();
    function sk_init() {
        isChat();
        ws = new WebSocket("ws://www.duiler.com:8585");
        /**
         * 连接建立时触发
         * {"type":"login", "uid":"访客标识", "role":"角色", "relation":"所属系统"}
         */
        ws.onopen = function () {
            msg = {};
            msg.type = "login"; //消息类型
            msg.uid = uid; //访客标识id
            msg.role = role; //访客身份
            msg.relation = relation; //所属客服系统
            ws.send(JSON.stringify(msg));
        };
        //有消息到来时触发
        //更新会话列表  更新聊天信息
        ws.onmessage = function (e) {
            msg = JSON.parse(e.data);
            if(msg.type == 'visitor'){
                //访客进入事件
                !!$b.find("#user-list").length||isChat(true);
                if(!$b.find("#"+msg.clientUid).length){
                    var user_html = "<a href=\"javscript:;\" id=\""+msg.clientUid+"\" data-online=\"1\" class=\"list-group-item\"><span class=\"list-group-item-heading\">Guest_"+msg.clientUid.substr(-8)+"<\/span><p class=\"list-group-item-text text-muted\">在线<\/p><p class=\"list-group-item-text text-ctime\">"+msg.ip+"<\/p><\/a>";
                    $b.find("#user-list").append(user_html);
                }else{
                    $b.find("#user-list #"+msg.clientUid).data("online",1).find(".text-muted").text("在线");
                    if(visitid == msg.clientUid)
                        $b.find("#msg-content").removeAttr("disabled");
                }
            }else if(msg.type == 'visitorExit'){
                //访客退出
                var $userlist_uid = $b.find("#user-list #"+msg.clientUid);
                if($userlist_uid.length){
                    $userlist_uid.find(".text-muted").text("已退出");
                    $userlist_uid.data("online",0);
                    if(visitid == msg.clientUid)
                        $b.find("#msg-content").val("").attr("disabled","disabled");
                }
            }else if(msg.type == 'text'){
                //对话事件
                chat(msg);
            }else if(msg.type == 'load'){
                //刷新加载已有在线访客
                isChat(true);
                var user_list = "";
                $.each(msg.list, function(index, item){
                    user_list += "<a href=\"javscript:;\" id=\""+index+"\" data-online=\"1\" class=\"list-group-item\"><span class=\"list-group-item-heading\">Guest_"+index.substr(-8)+"<\/span><p class=\"list-group-item-text text-muted\">在线<\/p><p class=\"list-group-item-text text-ctime\">"+item.ip+"<\/p><\/a>";
                });
                $b.find("#user-list").append(user_list);
            }
        };
        /**
         * 连接关闭事件
         */
        ws.onclose = function (e) {
            console.log("与服务器连接已断开");
        };
        /**
         * 异常事件
         */
        ws.onerror = function (e) {
            console.log("与服务器连接发生错误");
        };
    }
    //选择相关用户添加样式
    $b.on("click","#user-list a",function(){
        var $item = $(this);
        if(!$item.hasClass("active")){
            $item.addClass("active").siblings().removeClass("active");
            $item.find(".text-muted").text("在线");
            visitid = $item.attr("id"); //当前会话访客的uid
            chatPanelinfo();
            if($item.data("online") == 1){
                $b.find("#msg-content").removeAttr("disabled");
            }else{
                $b.find("#msg-content").attr("disabled","disabled");
            }
            //获取用户的相关信息
            $.get("/index.php?s=Chat/Index/getdata",{"visitid":visitid},function(data){
                if(data.status==1){
                    $("#username").val(data.info.username);
                    $("#email").val(data.info.email);
                    $("#address").val(data.info.address);
                    $("#mobile").val(data.info.mobile);
                }
            });
            //拉取聊天记录
            $.get("/index.php?s=Client/Index/pulllist",{"visitid":visitid,"relation":relation,"cuid":uid},function(data){
                if(data.status==1){
                    var $chatActive = $b.find("#chat-active");
                    var append_html = "";
                    $.each(data.info,function(index,item){
                        if(item.type!='chat'){
                                pullT = "right",
                                pullB = "bg-primary";
                            if(uid==item.from){
                                pullT = "left";
                                pullB = "";
                            }
                            item.content = item.content.replace(/\[em_([0-9]*)\]/g,'<img class="face" src="/Public/img/face/$1.png" border="0" />');
                            if(item.type === 'text'){ //文本消息
                                $chatActive.append("<div class=\"msg_list msg_"+pullT+" clearfix\"><div class=\"text "+pullB+"\"><p>"+item.content+"</p><span class=\"time\">"+item.time+"</span></div></div>");
                            }else if(item.type === 'img'){
                                //图片消息
                            }else if(item.type === 'attach'){
                                //附件消息
                            }
                        }
                    });
                    $chatActive.append(append_html);
                    $chatActive.scrollTop( $chatActive.get(0).scrollHeight);
                }
            });
        }
    });
    //结束当前会话
    $b.on("click","#end-chat",function(){
        if(!!visitid){
            msg = {};
            msg.type = "close";
            msg.role = "worker";
            msg.visitid = visitid;
            ws.send(JSON.stringify(msg));
        }
    });
    //回车检测发送信息
    $b.on("keypress","#msg-content",function(e){
        var conval = $.trim($(this).val());
        e.keyCode == "13" && e.preventDefault();
        if(e.keyCode == "13" && !!conval){
            msg = {};
            msg.type = "text";
            msg.to = visitid;
            msg.role = "worker";
            msg.content = conval;
            $(this).val("");
            ws.send(JSON.stringify(msg));
        }
    });
    //相关会话信息面板
    function chatPanelinfo(){
       var chatPanelinfo_html = '<div class="panel"><div class="panel-body"><div class="row"><div class="col-xs-8" style="border-right: 1px solid #dddddd;"><div class="chat-title clearfix"><span class="pull-left">会话详情</span><a id="end-chat" class="btn btn-sm pull-right btn-primary">结束会话</a></div><div id="chat-active" class="chat-active"></div></div><div class="col-xs-4"><div><ul class="nav nav-secondary nav-justified"><li class="active"><a href="#tab1" data-toggle="tab">用户资料</a></li><li class=""><a href="javascript:;">&nbsp;</a></li></ul><div class="tab-content"><div class="tab-pane in active" id="tab1"><form class="form-horizontal data-panel"><div class="form-group"><label class="col-xs-1 control-label pd-top10">姓名</label><div class="col-xs-7"><input type="text" name="username" id="username" value="" placeholder="访客真实姓名" class="data-panel-input form-control input-lg input-b-hide"></div></div><div class="form-group"><label class="col-xs-1 control-label pd-top10">手机</label><div class="col-xs-7"><input type="text" name="mobile" id="mobile" value="" placeholder="访客联系方式" class="data-panel-input form-control input-lg input-b-hide"></div></div><div class="form-group"><label class="col-xs-1 control-label pd-top10">邮箱</label><div class="col-xs-7"><input type="text" name="email" id="email" value=""placeholder="访客邮箱" class="data-panel-input form-control input-lg input-b-hide"></div></div><div class="form-group"><label class="col-xs-1 control-label pd-top10">地址</label><div class="col-xs-7"><input type="text" name="address" id="address" value="" placeholder="访客详细地址" class="data-panel-input form-control input-lg input-b-hide"></div></div></form></div></div></div></div></div></div><div class="panel-footer"><div class="row"><div class="col-xs-8 control_footer"><div class="control_face"></div><div class="z_main_ext"><a class="ele_btn ele_btn_face"><i class="icon-smile icon-2x"></i></a></div><div class="z_main_text"><textarea id="msg-content" class="form-control input-lg" rows="2" placeholder="请输入要发送的消息..."></textarea></div></div></div></div></div>';
        $b.find("#chat-panel-info").html(chatPanelinfo_html);
        //加载表情
        for(var i = 0; i<12; i++){
            $b.find(".control_face").append('<img class="img_face" src="/Public/img/face/'+i+'.png" data-id="'+i+'">');
        }
    }
    //无会话和有会话
    function isChat(istrue){
        var istrue = !!istrue;
        var chathtml = istrue?'<div class="col-xs-3"><div class="panel"><div class="panel-body chat-list"><div class="chat-art">当前会话</div><div class="list-group" id="user-list"></div></div></div></div><div id="chat-panel-info" class="col-xs-9"></div></div>':'<p class="no-chat-tip">暂无会话消息</p>';
        $b.find("#chat-main-panel").html(chathtml);
    };
    //聊天函数
    function chat(msg){
        if(visitid && (visitid == msg.visitid)){
            var $chatActive = $b.find("#chat-active"),
                pullT = "right",
                pullB = "bg-primary";
            if(msg.visitid!=msg.from){
                pullT = "left";
                pullB = "";
            }
            msg.content = msg.content.replace(/\[em_([0-9]*)\]/g,'<img class="face" src="/Public/img/face/$1.png" border="0" />');
            if(msg.type === 'text'){ //文本消息
                $chatActive.append("<div class=\"msg_list msg_"+pullT+" clearfix\"><div class=\"text "+pullB+"\"><p>"+msg.content+"</p><span class=\"time\">"+msg.time+"</span></div></div>");
            }else if(msg.type === 'img'){
                //图片消息

            }else if(msg.type === 'attach'){
                //附件消息

            }
        }else{
            $b.find("#user-list #"+msg.visitid).find(".text-muted").text("新消息");
        }
        $b.find("#chat-active").scrollTop( $b.find("#chat-active").get(0).scrollHeight);
    };
    //表情按钮
    $b.on("click",".ele_btn_face",function(){
        $b.find(".control_face").toggle();
    });
    //表情添加
    $b.on('click', '.control_face .img_face', function(){
        insertAtCaret('[em_'+$(this).data("id")+']');
        $b.find(".control_face").hide();
        $b.find('#msg-content').focus();
    });
    function insertAtCaret(textFeildValue){
        var textObj = $b.find('#msg-content').get(0);
        if(document.all && textObj.createTextRange && textObj.caretPos){
            var caretPos=textObj.caretPos;
            caretPos.text = caretPos.text.charAt(caretPos.text.length-1) == '' ?
            textFeildValue+'' : textFeildValue;
        } else if(textObj.setSelectionRange){
            var rangeStart=textObj.selectionStart;
            var rangeEnd=textObj.selectionEnd;
            var tempStr1=textObj.value.substring(0,rangeStart);
            var tempStr2=textObj.value.substring(rangeEnd);
            textObj.value=tempStr1+textFeildValue+tempStr2;
            textObj.focus();
            var len=textFeildValue.length;
            textObj.setSelectionRange(rangeStart+len,rangeStart+len);
            textObj.blur();
        }else{
            textObj.value+=textFeildValue;
        }
    };
});