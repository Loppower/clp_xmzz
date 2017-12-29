<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\module\index.html";i:1511148963;s:75:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\common\head.html";i:1512630547;s:75:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\common\foot.html";i:1503623995;}*/ ?>
<!DOCTYPE html>
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
        <legend><?php echo lang('module'); ?><?php echo lang('list'); ?></legend>
    </fieldset>
    <blockquote class="layui-elem-quote">
        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-sm"><?php echo lang('add'); ?><?php echo lang('module'); ?></a>
    </blockquote>
    <table class="layui-table" id="list" lay-filter="list"></table>
</div>
<script type="text/javascript" src="__STATIC__/plugins/layui/layui.js"></script>


<script type="text/html" id="action">
    <a href="<?php echo url('field'); ?>?id={{d.id}}" class="layui-btn layui-btn-normal layui-btn-xs">模型字段</a>
    <a href="<?php echo url('edit'); ?>?id={{d.id}}" class="layui-btn layui-btn-xs"><?php echo lang('edit'); ?></a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><?php echo lang('del'); ?></a>
</script>
<script type="text/html" id="status">
    <input type="checkbox" name="status" value="{{d.id}}" lay-skin="switch" lay-text="开启|禁用" lay-filter="status" {{ d.status == 1 ? 'checked' : '' }}>
</script>
<script>
    layui.use(['table','form'], function() {
        var table = layui.table, form=layui.form,$ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("index"); ?>',
            method: 'post',
            page:true,
            cols: [[
                {field: 'id', title: '<?php echo lang("id"); ?>', width:60, fixed: true},
                {field: 'title', title: '<?php echo lang("module"); ?><?php echo lang("name"); ?>', width: 120},
                {field: 'name', title: '<?php echo lang("table"); ?>', width: 100},
                {field: 'description', title: '<?php echo lang("detail"); ?>', width: 180},
                {field: 'status', align: 'center',title: '<?php echo lang("status"); ?>', width: 80,toolbar: '#status'},
                {width: 200, align: 'center', toolbar: '#action'}
            ]]
        });
        form.on('switch(status)', function(obj){
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var status = obj.elem.checked===true?1:0;
            $.post('<?php echo url("moduleState"); ?>',{'id':id,'status':status},function (res) {
                layer.close(loading);
                if (res.status==1) {
                    tableIn.reload();
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                    return false;
                }
            })
        });
        table.on('tool(list)', function(obj) {
            var data = obj.data;
            if(obj.event === 'del'){
                layer.confirm('你确定要删除该模型吗？', {icon: 3}, function (index) {
                    $.post("<?php echo url('del'); ?>",{id:data.id},function(res){
                        if(res.code==1){
                            layer.msg(res.msg,{time:1000,icon:1});
                            tableIn.reload();
                        }else{
                            layer.msg(res.msg,{time:1000,icon:2});
                        }
                    });
                    layer.close(index);
                });
            }
        });
    })
</script>