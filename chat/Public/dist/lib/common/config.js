/**
 * Created by zhangyanpo on 2016/3/17.
 */
var sysid = window.location.href.split("/").pop().split(".").shift();
var webim = {
    "server" : "ws://www.duiler.com:8585",
    "offical": "http://www.duiler.com"
};
var logger;
if (window.console && window.console.log && window.console.error) {
    logger = window.console;
} else {
    //在某些环境下，控制台定义但console.log或console.error失踪
    logger = {log: function(){}, error: function(){ }};
}
var ws = {};
//body元素对象
var $b = $("body");
//主窗体对象
var $kefu_panel = $("body>#kefu_panel");
//访客标识
var uid = $.cookie("uid");
//当前接待客服 ,聊天过程中也有可能刷新页面的情况
var group = $.cookie("group");
//终端类型
var app = (/Android|Windows Phone|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) && !/MI PAD/i.test(navigator.userAgent))?"m":"p";
// 当前界面模式 1错误界面模式 2对话界面模式 3留言界面模式 4二维码页面
var mode;
//播放提示音 是否静音 默认声音开启
var mute = 1; //0静音
//创建声音提示元素
var audio_box = document.createElement("audio");
audio_box.setAttribute("id", "audio_box");
audio_box.setAttribute("src", "/Public/img/voice.mp3");
//标题是否已经修改
var doedit = 0;