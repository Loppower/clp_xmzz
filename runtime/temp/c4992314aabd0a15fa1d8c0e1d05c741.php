<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\wechat\config.html";i:1507453218;s:75:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\common\head.html";i:1512630547;s:75:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\common\foot.html";i:1503623995;}*/ ?>
<script src="../../../../public/static/common/js/jquery.2.1.1.min.js"></script><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo config('sys_name'); ?>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="__STATIC__/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="__ADMIN__/css/global.css" media="all">
    <link rel="stylesheet" href="__STATIC__/common/css/font.css" media="all">
</head>
<body class="skin-<?php if(!empty($_COOKIE['skin'])){echo $_COOKIE['skin'];}else{echo '0';setcookie('skin','0');}?>">
<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend><?php echo $title; ?></legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('AppID'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="appid" lay-verify="required" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('AppID'); ?>" value="<?php echo $wchat_config['appid']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('Appsecret'); ?></label>
            <div class="layui-input-4">
                <input type="text" name="appsecret" lay-verify="required" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('Appsecret'); ?>" value="<?php echo $wchat_config['appsecret']; ?>" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                AppID以及Appsecret来自于您申请开发接口时提供的账号和密码。
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">URL</label>
            <div class="layui-input-4">
                <input class="layui-input" id="url" readonly value="<?php echo $call_back_url; ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">TOKEN</label>
            <div class="layui-input-4">
                <input type="text" name="token" placeholder="输入TOKEN" class="layui-input" value="<?php echo $wchat_config['token']; ?>">
            </div>
            <div class="layui-form-mid layui-word-aux">
                请将以上URL及Token填到微信公众平台中，以完成绑定。
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="__STATIC__/plugins/layui/layui.js"></script>



<script>
    layui.use(['form', 'layer'], function () {
        var form = layui.form, layer = layui.layer, $ = layui.jquery;
        form.on('submit(submit)', function (data) {
            var loading = layer.load(1, {shade: [0.1, '#fff']});
            $.post("<?php echo url('setWechatConfig'); ?>",data.field,function (res) {
                layer.close(loading);
                if(res.code > 0){
                    layer.msg(res.msg,{icon: 1, time: 1000},function(){
                        location.href = res.url;
                    });
                }else{
                    layer.msg(res.msg,{icon: 2, time: 1000});
                }
            });
        });

    })
</script>
</body>
</html>