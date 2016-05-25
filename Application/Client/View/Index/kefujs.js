/**
 * Created by zhangyanpo on 2016/3/17.
 */

//加载Messenger.js
window.Messenger = (function(){

    // 消息前缀, 建议使用自己的项目名, 避免多项目之间的冲突
    // !注意 消息前缀应使用字符串类型
    var prefix = "[PROJECT_NAME]",
        supportPostMessage = 'postMessage' in window;

    // Target 类, 消息对象
    function Target(target, name, prefix){
        var errMsg = '';
        if(arguments.length < 2){
            errMsg = 'target error - target and name are both required';
        } else if (typeof target != 'object'){
            errMsg = 'target error - target itself must be window object';
        } else if (typeof name != 'string'){
            errMsg = 'target error - target name must be string type';
        }
        if(errMsg){
            throw new Error(errMsg);
        }
        this.target = target;
        this.name = name;
        this.prefix = prefix;
    }

    // 往 target 发送消息, 出于安全考虑, 发送消息会带上前缀
    if ( supportPostMessage ){
        // IE8+ 以及现代浏览器支持
        Target.prototype.send = function(msg){
            this.target.postMessage(this.prefix + '|' + this.name + '__Messenger__' + msg, '*');
        };
    } else {
        // 兼容IE 6/7
        Target.prototype.send = function(msg){
            var targetFunc = window.navigator[this.prefix + this.name];
            if ( typeof targetFunc == 'function' ) {
                targetFunc(this.prefix + msg, window);
            } else {
                throw new Error("target callback function is not defined");
            }
        };
    }

    // 信使类
    // 创建Messenger实例时指定, 必须指定Messenger的名字, (可选)指定项目名, 以避免Mashup类应用中的冲突
    // !注意: 父子页面中projectName必须保持一致, 否则无法匹配
    function Messenger(messengerName, projectName){
        this.targets = {};
        this.name = messengerName;
        this.listenFunc = [];
        this.prefix = projectName || prefix;
        this.initListen();
    }

    // 添加一个消息对象
    Messenger.prototype.addTarget = function(target, name){
        var targetObj = new Target(target, name,  this.prefix);
        this.targets[name] = targetObj;
    };

    // 初始化消息监听
    Messenger.prototype.initListen = function(){
        var self = this;
        var generalCallback = function(msg){
            if(typeof msg == 'object' && msg.data){
                msg = msg.data;
            }

            var msgPairs = msg.split('__Messenger__');
            var msg = msgPairs[1];
            var pairs = msgPairs[0].split('|');
            var prefix = pairs[0];
            var name = pairs[1];

            for(var i = 0; i < self.listenFunc.length; i++){
                if (prefix + name === self.prefix + self.name) {
                    self.listenFunc[i](msg);
                }
            }
        };

        if ( supportPostMessage ){
            if ( 'addEventListener' in document ) {
                window.addEventListener('message', generalCallback, false);
            } else if ( 'attachEvent' in document ) {
                window.attachEvent('onmessage', generalCallback);
            }
        } else {
            // 兼容IE 6/7
            window.navigator[this.prefix + this.name] = generalCallback;
        }
    };

    // 监听消息
    Messenger.prototype.listen = function(callback){
        var i = 0;
        var len = this.listenFunc.length;
        var cbIsExist = false;
        for (; i < len; i++) {
            if (this.listenFunc[i] == callback) {
                cbIsExist = true;
                break;
            }
        }
        if (!cbIsExist) {
            this.listenFunc.push(callback);
        }
    };
    // 注销监听
    Messenger.prototype.clear = function(){
        this.listenFunc = [];
    };
    // 广播消息
    Messenger.prototype.send = function(msg){
        var targets = this.targets,
            target;
        for(target in targets){
            if(targets.hasOwnProperty(target)){
                targets[target].send(msg);
            }
        }
    };

    return Messenger;
})();

//js初始化加载
(function(){
    var host_url = "{$host_url}";
    //加载初始化div
    var d_main_btn = document.createElement("div");
    d_main_btn.setAttribute("id", "kefu_main_btn");
    d_main_btn.innerHTML = "<a style=\"text-decoration: none; outline: none; font-family: Microsoft Yahei, Arial, Helvetica; color: #fff; font-size: 16px; display: inline-block; margin: 0; padding: 0; border: none; line-height:43px; float:none;cursor: pointer;\"><img style=\"vertical-align: middle; width: 31px; border:none; margin: -4px 10px 0 0; float: none; position: static; height: 27px;\" src=\""+host_url+"/Public/img/tb.png\"><span class=\"font-family: Microsoft Yahei, Arial, Helvetica; color: #fff; font-size:16px; margin: 0; padding: 0; \">{$title}<\/span></a>";
    document.body.appendChild(d_main_btn);

    d_main_btn.style.cssText = "position: fixed; z-index: 9999999999; box-sizing: content-box; height: 43px; bottom: 0px; padding: 0px 20px; border-radius: 4px 4px 0px 0px; right:80px; background-color:{$style};";
    //加载对话框div
    var d_main_box = document.createElement("div");
    d_main_box.setAttribute("id", "kefu_frame_box");
    d_main_box.style.cssText = "width: 320px; height: 480px; position: fixed; bottom: 0px; border-radius: 5px 5px 0px 0px;border:1px solid #E5E5E5; overflow: hidden; z-index: 9999999999; right: 80px;display:none;";
    //加载iframe
    var d_main_box_iframe = document.createElement("iframe");

    d_main_box_iframe.setAttribute("id","kefu_iframe");
    d_main_box_iframe.setAttribute("name","kefu_iframe");
    d_main_box_iframe.setAttribute("frameborder","no");
    d_main_box_iframe.setAttribute("scrolling","no");
    d_main_box_iframe.setAttribute("src", host_url+"{$client_url}");

    d_main_box_iframe.style.cssText = "width: 100%; height: 100%; border: 0;";

    d_main_box.appendChild(d_main_box_iframe);
    document.body.appendChild(d_main_box);
    d_main_btn.onclick = function(){
        this.style.display = "none";
        d_main_box.style.display = "block";
    };

    //跨域调用
    var messenger = new Messenger('parent');
    var iframe = document.getElementById('kefu_iframe');
    messenger.addTarget(iframe.contentWindow, 'iframe');
    messenger.listen(function (msg) {
        if(msg === 'ele_min'){
            d_main_box.style.display = "none";
            d_main_btn.style.display = "block";
        }
    });


})();

