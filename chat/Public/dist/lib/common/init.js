/**
 * Created by zhangyanpo on 2016/3/17.
 */

//初始化
$(function(){
    //官网链接
    $b.on("click","#offical_web",function(){
        window.open(webim.offical);
    });
    //判断当前客服系统是否存在
    $.get("/index.php?s=Client/Index/isExist",{"sysid":sysid},function(d){
        if(d.status==1){
            relation = d.info.companyid;
            //样式加载
            var setstyle = !!d.info.style?d.info.style:"default";
            $("<link>").attr({ rel: "stylesheet",type: "text/css",href: "/Public/dist/css/zui-"+setstyle+"-theme.css"}).appendTo("head");
            sk_init();
        }else{
            error_block();
        }

    });
   //初始化插件提示
    var messenger = new Messenger('iframe');
    messenger.addTarget(window.parent, 'parent');
    //窗口最大化/最小化
    $b.on("click",".ele_btn_min",function(){
        messenger.targets['parent'].send("ele_min");
    });
    //声音开启/关闭
    $b.on("click",".ele_btn_voice",function(){
        var $voice_i = $(this).find("i");
        if($voice_i.hasClass("icon-volume-up")){
            $voice_i.removeClass("icon-volume-up");
            $voice_i.addClass("icon-volume-off");
            mute = 0; //静音
        }else{
            $voice_i.removeClass("icon-volume-off");
            $voice_i.addClass("icon-volume-up");
            mute = 1;
        }
    });
});