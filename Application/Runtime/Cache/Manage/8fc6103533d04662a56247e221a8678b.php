<?php if (!defined('THINK_PATH')) exit();?><form class="kefu_reg form-horizontal">
    <div class="form-group">
        <label class="col-xs-2 control-label">客服账号</label>
        <div class="col-xs-9">
            <?php if(!empty($userinfo)): ?><input type="hidden" name="uid" value="<?php echo ($userinfo["uid"]); ?>">
                <label style="padding-top: 5px;"><?php echo ($userinfo["account"]); ?></label>
            <?php else: ?>
                <input type="text" name="account" data-fic="fic" data-type="/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/" data-null="邮箱/账号不能为空" data-error="邮箱格式错误" placeholder="请输入邮箱，默认为登录账号" id="account" value="" class="form-control input-lg"><?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-1 control-label">设置密码</label>
        <div class="col-xs-9">
            <?php if(!empty($userinfo)): ?><input type="password" name="password" data-fic="fic" data-type="/(^[\s]{0}$)|(^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,16}$)/" data-error="密码格式错误" placeholder="请输入密码 6到16位字符" id="password" value="" class="form-control input-lg">
            <?php else: ?>
                <input type="password" name="password" data-fic="fic" data-type="/^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,16}$/" data-null="密码不能为空" data-error="密码格式错误" placeholder="请输入密码 6到16位字符" id="password" value="" class="form-control input-lg"><?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-1 control-label">姓名</label>
        <div class="col-xs-9">
            <input  type="text" name="truename" id="truename" placeholder="用户真实姓名" value="<?php echo ($userinfo["truename"]); ?>" class="form-control input-lg">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-1 control-label">昵称</label>
        <div class="col-xs-9">
            <input type="text" name="nickname" placeholder="用于访客端聊天窗口的显示" id="nickname" value="<?php echo ($userinfo["nickname"]); ?>" class="form-control input-lg">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-1 control-label">手机号</label>
        <div class="col-xs-9">
            <input type="text" name="mobile" placeholder="用于企业内部通讯" id="mobile" value="<?php echo ($userinfo["mobile"]); ?>" class="form-control input-lg">
        </div>
    </div>
    <?php if(!empty($userinfo)): ?><div class="form-group">
        <label class="col-xs-1 control-label">邮箱</label>
        <div class="col-xs-9">
            <input type="text" name="email" placeholder="用于企业内部通讯" id="email" value="<?php echo ($userinfo["email"]); ?>" class="form-control input-lg">
        </div>
    </div><?php endif; ?>
    <div class="form-group">
        <label class="col-xs-2 control-label"></label>
        <div class="col-xs-9 text-right">
            <button class="btn btn-primary btn-submit input-lg disabled" data-loading-text="正在提交中..."> 确 定 </button>
        </div>
    </div>
</form>
<script>
    //表单提交
    $(function(){
        $(".kefu_reg").propChange({
            btnSubmit:".btn-submit",
            actionUrl:"<?php echo U('Manage/Kefu/doedit');?>",
            fromRefresh:true
        });
    });
</script>