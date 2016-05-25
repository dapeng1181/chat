/**
 * Created by zhangyanpo on 2016/3/17.
 */

//socket初始化
function sk_init() {
    if (window.WebSocket) {
    } else if (window.MozWebSocket) {
        window.WebSocket = MozWebSocket;
    }else{
        //访客端是电脑时 显示二维码 ，扫描转到手机
        if(app==='p'){
            qrcode_block();
        }else{
            message_block();
        }
        return;
    }
    ws = new WebSocket(webim.server);
    /**
     * 连接建立时触发
     * {"type":"login", "uid":"访客标识", "role":"角色", "relation":"所属系统"}
     */
    ws.onopen = function () {
        msg = {};
        msg.type = "login"; //消息类型
        msg.uid = uid; //访客标识id
        msg.group = group; //当前接待客服
        msg.role = "visitor"; //访客身份
        msg.relation = relation; //所属客服系统
        msg.app = app; //终端类型
        ws.send(JSON.stringify(msg));
    };
    //有消息到来时触发
    ws.onmessage = function (e) {
        msg = JSON.parse(e.data);
        if(!!msg.uid){
            uid = msg.uid;
            $.cookie("uid", uid);
        }
        if(!!msg.group){
            group = msg.group;
            $.cookie("group", group);
        }
        if(msg.type == 'message'){
            //留言事件
            message_block();
        }else if(msg.type == 'wait'){
            //排队事件
            if(mode !== 2){
                chat_block();
            }
            $b.find("#panel_title").text("排队等待");
            chat(msg,true,"排队等待");
        }else if($.inArray(msg.type,['text','img','attach'])>-1){
            //对话事件
            if(mode !== 2){
                chat_block();
            }
            chat(msg);
        }else if(msg.type == 'close'){
            //客服关闭会话
            ws.close();
            chat(msg,true,"会话已关闭");
        }else if(msg.type == 'chat'){
            //有客服接待事件
            if(mode !== 2){
                chat_block();
            }
            $b.find("#panel_title").text(msg.groupname);
            chat(msg,true,"客服 "+msg.groupname+" 接待了您");
            //拉取聊天记录
            $.get("/index.php?s=Client/Index/pulllist",{"visitid":uid,"relation":relation,"cuid":group},function(data){
                if(data.status==1){
                    var $chatActive = $b.find("#ms_chat_main_body");
                    var append_html = "";
                    $.each(data.info,function(index,item){
                        if(item.type!='chat'){
                                pullB = "bg-primary",
                                pullT = "right";
                            if(uid!=item.from){
                                var pullT = "left", //默认消息左对齐
                                    pullB = "";
                            }
                            item.content = item.content.replace(/\[em_([0-9]*)\]/g,'<img class="face" src="/Public/img/face/$1.png" border="0" />');
                            if(item.type === 'text'){ //文本消息
                                append_html+="<div class=\"msg_list msg_"+pullT+" clearfix\"><div class=\"text "+pullB+"\"><p>"+item.content+"</p><span class=\"time\">"+item.time+"</span></div></div>";
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
    };
    /**
     * 连接关闭事件
     */
    ws.onclose = function (e) {
        if(mode == 2){
            //console.log("对话已关闭");
        }else{
            message_block();
        }
    };
    /**
     * 异常事件
     */
    ws.onerror = function (e) {
        error_block();
    };
}
//当前客服系统不可用时的处理函数
function error_block(){
    empty_window();
    $kefu_panel.html('<div id="error_main_panel"><div class="ms_header bg-primary"><div id="panel_title" class="control_title pull-left">消息</div><div class="control_win pull-right"><a class="ele_btn ele_btn_min"><i class="icon-angle-down"></i></a></div></div><div class="ms_body"><div class="alert alert-warning"> 当前客服系统暂时无法使用<hr>点击<a class="alert-link" id="offical_web">了解更多</a></div></div><div class="ms_footer ms_min_footer"><a id="offical_web" class="ele_txt">开源客服系统</a></div></div>');
    mode = 1;
    document.title = "提示信息";
}
//当前客服系统存在时
function chat_block(){
    empty_window();
    $kefu_panel.html('<div id="chat_main_panel"><div class="ms_header bg-primary"><div id="panel_title" class="control_title pull-left"></div><div class="control_win pull-right"><a class="ele_btn ele_btn_min"><i class="icon-angle-down"></i></a><a class="ele_btn ele_btn_voice"><i class="icon-volume-up"></i></a></div></div><div id="ms_chat_main_body" class="ms_body"></div><div class="ms_footer"><div class="control_text"><textarea id="textarea" placeholder="请输入..."></textarea></div><div class="control_element"><div class="control_ele_left pull-left"><a class="ele_btn ele_btn_face"><i class="icon-smile icon-2x"></i></a><a class="ele_btn"><i class="icon-cloud-upload icon-2x"></i></a><a id="offical_web" class="ele_btn ele_txt">开源客服系统</a></div><div class="control_ele_right pull-right"><button id="btn_send" class="btn btn-primary" type="button">发送</button></div></div><div class="control_face"></div></div></div>');
    //加载表情
    for(var i = 0; i<12; i++){
        $b.find(".control_face").append('<img class="img_face" src="/Public/img/face/'+i+'.png" data-id="'+i+'">');
    }
    mode = 2;
}
//显示留言界面
function message_block(){
    empty_window();
    $kefu_panel.html("<div id=\"message_main_panel\"><div class=\"ms_header bg-primary\"><div id=\"panel_title\" class=\"control_title pull-left\">在线留言<\/div><div class=\"control_win pull-right\"><a class=\"ele_btn ele_btn_min\"><i class=\"icon-angle-down\"><\/i><\/a><\/div><\/div><div id=\"ms_message_main_body\" class=\"ms_body\"><form id=\"message\" class=\"message form-horizontal\"><input type=\"hidden\" name=\"companyid\" id=\"companyid\" ><input type=\"hidden\" name=\"visitid\" id=\"visitid\" ><div class=\"form-group\"><div class=\"col-xs-12\"><input type=\"text\" name=\"phone\"  placeholder=\"请输入手机号\" id=\"phone\" class=\"form-control input-lg\"><\/div><\/div><div class=\"form-group\"><div class=\"col-xs-12\"><input type=\"text\" name=\"email\"  placeholder=\"请输入邮箱地址\" id=\"email\" class=\"form-control input-lg\"><\/div><\/div><div class=\"form-group\"><div class=\"col-xs-12\"><textarea class=\"form-control input-lg\" rows=\"3\" id=\"content\" name=\"content\" placeholder=\"请输入留言内容 15-50个字符\"><\/textarea><\/div><\/div><div class=\"form-group\"><div class=\"col-xs-12 text-right\"><button id=\"message_btn\" class=\"btn btn-primary input-lg btn-block\" data-loading-text=\"正在提交中...\"> 提 交 <\/button><\/div><\/div><\/form><\/div><div class=\"ms_footer ms_min_footer\"><a id=\"offical_web\" class=\"ele_txt\">开源客服系统<\/a><\/div><\/div><script>$(\"#companyid\").val(relation);$(\"#visitid\").val(uid);$(\"#message_btn\").on(\"click\",function(e){var eve=e||window.event;try{eve.preventDefault();}catch(e){eve.returnValue = false;}$.post(\"\/index.php?s=Client\/Index\/message\",$(\"#message\").serialize(),function(data){alert(data.info);if(data.status==1){$(\"#ms_message_main_body\").html(\"<div class=\'alert alert-warning\'>留言内容已提交<\/div>\");}})})<\/script>");
    document.title = "在线留言";
    mode = 3;
}
//显示二维码页面
function qrcode_block(){
    empty_window();
    $kefu_panel.html('<div id="error_main_panel"><div class="ms_header bg-primary"><div id="panel_title" class="control_title pull-left">二维码</div><div class="control_win pull-right"><a class="ele_btn ele_btn_min"><i class="icon-angle-down"></i></a></div></div><div class="ms_body"><div class="alert alert-warning"> 微信/手机浏览器扫描二维码</div><div id="chat_qrcode"></div></div><div class="ms_footer ms_min_footer"><a id="offical_web" class="ele_txt">开源客服系统</a></div></div>');
    document.title = "手机扫描二维码";
    $b.find("#chat_qrcode").qrcode({render: "table",width: 200,height:200,text: window.location.href});
    mode = 4;
}
//清空窗体
function empty_window(){
    $kefu_panel.empty();
}
//留言提交

//聊天函数
function chat(msg,tip,con){
    if(mode!==2)
        return false;
    var tip = !!tip?true:false;
    if(group && uid && !tip){
        var $chatActive = $b.find("#ms_chat_main_body"),
            pullB = "bg-primary",
            pullT = "right";
        if(uid!=msg.from){
            editTitle();
            voicePlay();
            var pullT = "left", //默认消息左对齐
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
        $b.find("#ms_chat_main_body").append('<p class="msg_tip">—— '+con+' ——</p>');
    }
    $b.find("#ms_chat_main_body").scrollTop( $b.find("#ms_chat_main_body").get(0).scrollHeight);
}
//播放声音
function voicePlay(){
    !mute||audio_box.play();
}
//标题修改
function editTitle(){
    if(doedit==0){
        doedit = 1;
        var oldtitle = document.title;
        document.title = '您有新的消息';
        setTimeout(function(){
            document.title = oldtitle;
            doedit = 0;
        },2000);
    }
}
//表情按钮
$b.on("click",".ele_btn_face",function(){
    $(".control_face").toggle();
});
//表情添加
$b.on('click', '.control_face .img_face', function(){
    insertAtCaret('[em_'+$(this).data("id")+']');
    $(".control_face").hide();
});
function insertAtCaret(textFeildValue){
    var textObj = $('#textarea').get(0);
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
//回车和发送检测
$b.on("keypress","#textarea",function(e){
    e.keyCode == "13" && e.preventDefault();
    if(e.keyCode == "13"){
        $b.find("#btn_send").trigger("click");
    }
});
$b.on("click","#btn_send",function(e){
    var conval = $.trim($b.find("#textarea").val());
    if(!!conval){
        msg = {};
        msg.type = "text";
        msg.to = group;
        msg.role = "visitor";
        msg.content = conval;
        $b.find("#textarea").val("");
        ws.send(JSON.stringify(msg));
    }
});
