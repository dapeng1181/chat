<?php
/**
 * Created by PhpStorm.
 * User: zhangyanpo
 * Date: 2016/3/25
 * Time: 14:36
 */
/**
 * 验证码检测
 * @param $code
 * @param string $id
 * @return bool
 */
function checkCode($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * 字符串添加反斜杠
 * @param $string
 */
function magicAddslashes($string){
    //MAGIC_QUOTES_GPC 常量在ThinkPHP.php文件中，判断系统是否支持或是否打开get_magic_quotes_gpc()
    return (!MAGIC_QUOTES_GPC)?addslashes($string):$string;
}

/**
 * 正常输出
 * @param $string
 * @return string
 */
function magicStripslashes($string){
    return htmlspecialchars_decode(stripslashes($string));
}