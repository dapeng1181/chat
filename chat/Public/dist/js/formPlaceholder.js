/**
 * Created by zhangyanpo on 2016/3/17.
 */
//placeholder 兼容性解决方案
$(function(){
    //判断是否支持placeholder属性
    if(!("placeholder" in document.createElement("input"))){
        $("input,textarea").each(function(index, item){
            var $item = $(item);
            if(!!$item.attr("placeholder") || !$item.val()){

                $("<div></div>").css({"position":"absolute","z-index":"10","border":"0","margin":$item.parent().css("padding"),"top":"0","left":"0","font-size":$item.css("font-size"),"color":"#8B8989","padding":$item.css("padding")}).html($item.attr("placeholder")).addClass("f-placeholder placeholder-"+$item.attr("name")).insertAfter($item);
                $item.addClass("f-placeholder-input");
            }
        });
        $("body").on("click",".f-placeholder",function(){
            $(this).parent().find(".f-placeholder-input").focus();
        });
        $("body").on("blur",".f-placeholder-input",function(){
            if(!$(this).val()) {
                $(this).parent().find(".f-placeholder").show();
            }else{
                $(this).parent().find(".f-placeholder").hide();
            }
        });
        $("body").on("focus",".f-placeholder-input",function(){
            $(this).parent().find(".f-placeholder").hide();
        });
    }
});
