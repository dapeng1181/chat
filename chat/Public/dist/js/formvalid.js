/**
 * Created by zhangyanpo on 2016/3/17.
 * 版本缺陷:一个页面只允许实例化一次； 实例化多次的话 会出现配置参数冲突
 */

;(function($){

    var formValid = {
        options:{}, //默认参数设置
        util:{} //检测和判断函数
    };
    formValid.options = {
        imgCode:"", //表单验证码按钮
        btnSubmit:"#btn-submit", //提交按钮
        actionUrl:window.location.href, //提交url 默认为当前网页
        fromRefresh:false,//表单提交后是否刷新页面 true|false
        formStatus:"normal", //表单状态 //normal | posting | posted //防止表单重复提交
        passed : false//表单检测是否通过 false|true
    };
    formValid.util = {
        dataPopover:function($item, value){  //$item是元素对象，value提示信息
            $item.popover('destroy');
            $item = $item||$(this);
            value = value||"填写错误";
            $item.popover({
                placement:'top',
                content:value,
                trigger:'manual'
            });
            $item.parent().removeClass("has-success").addClass("has-error");
            $item.popover('show');
        },
        blurCheck:function($item, r){
            var r = !r && true; //默认为true
            var dataval = $item.val(),    //当前元素的值
                datanull = $item.data("null"),  //为空的提示信息
                dataerror = $item.data("error"), //错误提示信息
                datatype = $item.data("type");  //正则验证格式
                datarecheck = $item.data("recheck"); //重复检测
            if(!dataval && !!datanull){  //没有值并且设置了空值的提示信息
                if(r)  formValid.util.dataPopover($item, datanull);
                return false;
            }else if(!!datarecheck){  //重复检测 eq密码
                var $datarecheck = $("#"+datarecheck);
                if($datarecheck.length > 0){
                    if(dataval !== $datarecheck.val()){
                        if(r)  formValid.util.dataPopover($item, dataerror);
                        return false;
                    }else{
                        if(r){
                            $item.popover('destroy');
                            $item.parent().removeClass("has-error").addClass("has-success");
                        }
                        return true;
                    }
                }
            }else if(!datatype){ //没有设定检测类型 默认不检测
                return true;
            }else if(datatype){
                var reg = /\/.+\//g;
                datatype = datatype.match(reg)[0].slice(1,-1);
                var re = new RegExp(datatype);
                if (re.test(dataval)) {
                    if(r){
                        $item.popover('destroy');
                        $item.parent().removeClass("has-error").addClass("has-success");
                    }
                    return true;
                }else{
                    if(r)  formValid.util.dataPopover($item, dataerror);
                    return false;
                }
            }
        }
    };

    //是否填写完整插件
    $.fn.formIsComplete = function(){
        return this.each(function(){
            var $this = $(this);
            var $fic = $this.find("input,textarea");
            var $btnSubmit = $this.find(formValid.options.btnSubmit);
            $fic.each(function(index, item){
                var $item = $(item);   //只检测data-fic = fic的input元素
                if(!!$item.data("fic") && $item.data("fic")==='fic' && !formValid.util.blurCheck($item, true)){
                    $btnSubmit.addClass("disabled");
                    formValid.options.passed = false;
                    return false;
                }
                formValid.options.passed = true;
            });
            if(formValid.options.passed){
                $btnSubmit.removeClass("disabled");
            }
        });
    };
    //输入检测
    $.fn.propChange = function(options){
        formValid.options = $.extend({}, formValid.options, options);//初始化参数
        return this.each(function(){
            var $this = $(this);
            var $input = $this.find("input,textarea");
            //实时输入检测
            $input.on('input propertychange', function(){
                $this.formIsComplete();
            });
            //失去焦点检测
            $input.on('blur', function(){
                formValid.util.blurCheck($(this));
                $this.formIsComplete();
            });
            //检测按钮
            // if(!$this.find(formValid.options.btnSubmit).is(".disabled"))
            //     $this.find(formValid.options.btnSubmit).addClass("disabled");
            //验证码点击更换
            formValid.options.imgCode && $this.find(formValid.options.imgCode).on("click",function(){
                $(this).get(0).src = "/index.php?s=Manage/Login/code/"+Math.random();
            });
            //表单提交
            formValid.options.btnSubmit && $this.find(formValid.options.btnSubmit).on("click",function(){
                if($(this).is(".disabled") || !formValid.options.passed || formValid.options.formStatus!=="normal")
                    return false;
                $(this).button('loading');
                $.ajax({
                    type:"post",
                    url:formValid.options.actionUrl,
                    data:$this.serialize(),
                    beforeSend:function(){
                        formValid.options.formStatus = "posting";
                    },
                    success:function(data){
                        var $el = $this.find(formValid.options.btnSubmit);
                        var val = $el.is('input') ? 'val' : 'html';
                        if(data.status == 1){
                            $el[val]("<i class=\"icon-check\"><\/i> "+data.info);
                            setTimeout(function () {
                                if(!!data.url){
                                    window.location.href = data.url;
                                }else if(!data.url && formValid.options.fromRefresh){
                                    window.location.reload(true);
                                }else{
                                    $el.button('reset');
                                    setTimeout(function () {
                                        $el.addClass("disabled");
                                    });
                                }
                            }, 1000);
                        }else if(data.status == 0){
                            //如果当前表单有验证码 执行验证码更换
                            if(formValid.options.imgCode)
                                $this.find(formValid.options.imgCode).get(0).src = "/index.php?s=Manage/Login/code/"+Math.random();

                            var data_info = [];
                                if(!!data.info){
                                    data_info = data.info.split(":");
                                }
                            if(data_info.length==2 && !!data_info[1]){
                                $el[val]("<i class=\"icon-times\"><\/i> "+data_info[1]);
                                formValid.util.dataPopover($this.find("#"+data_info[0]), data_info[1]);
                            }else{
                                $el[val]("<i class=\"icon-times\"><\/i> "+data_info[0]);
                            }
                            setTimeout(function () {
                                $el.button('reset');
                                setTimeout(function () {
                                    $el.addClass("disabled");
                                });
                            }, 1000);
                        }
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert("页面数据出现异常");
                        // console.log(XMLHttpRequest);
                        // console.log(textStatus);
                        // console.log(errorThrown);
                        $this.find(formValid.options.btnSubmit).button('reset');
                        $this.find(formValid.options.btnSubmit).addClass("disabled");
                    },
                    complete:function(){
                        formValid.options.formStatus = "normal";
                    }
                });
                return false;
            });
        });
    };

})(jQuery);
