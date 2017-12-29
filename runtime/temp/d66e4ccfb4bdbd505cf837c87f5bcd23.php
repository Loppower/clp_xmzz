<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\module\fieldAddType.html";i:1508723446;}*/ ?>
<style>
.typeTable tr{padding-bottom: 5px;}
</style>
<?php switch($type): case "title": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td width="120">标题图片</td>
        <td>
            <input type="radio" name="setup[thumb]" value="1" title="是">
            <input type="radio" name="setup[thumb]" value="0" checked title="否">
        </td>
    </tr>
    <tr>
        <td>标题样式</td>
        <td>
            <input type="radio" name="setup[style]" value="1" title="是">
            <input type="radio" name="setup[style]" value="0" checked title=" 否">
        </td>
    </tr>
    <!--<tr>
        <td>文本框长度</td>
        <td><input type="text" class="layui-input input-text" size="5" name="setup[size]" value="" /></td>
    </tr>-->
</table>
<?php break; case "text": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <!--<tr>
        <td width="120">文本框长度</td>
        <td><input type="text" class="layui-input input-text" size="5" name="setup[size]" value="" /></td>
    </tr>-->
    <tr>
        <td>默认值</td>
        <td> <input type="text" class="layui-input input-text" size="50"  name="setup[default]" value="" /></td>
    </tr>
    <tr>
        <td>是否为密码框</td>
        <td>
            <input type="radio" name="setup[ispassword]" value="1" title="是">
            <input type="radio" name="setup[ispassword]" value="0" checked title="否">
        </td>
    </tr>
    <input type="hidden" id="varchar" name="setup[fieldtype]" value="varchar"/>
</table>
<?php break; case "textarea": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td>字段类型</td>
        <td>
            <select name="setup[fieldtype]">
                <option value="mediumtext" selected>MEDIUMTEXT</option>
                <option value="text">TEXT</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>默认值</td>
        <td><textarea  name="setup[default]" rows="3" cols="40" class="layui-textarea"></textarea></td>
    </tr>
</table>
<?php break; case "select": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td width="120">选项列表:<br>例: <font color="red">选项名称|值</font></td>
        <td>
            <textarea  name="setup[options]" rows="5" cols="40" class="layui-textarea"></textarea>
        </td>
    </tr>
    <tr>
        <td>选项类型</td>
        <td>
            <input type="radio" name="setup[multiple]" value="0" checked title="下拉框">
            <input type="radio" name="setup[multiple]" value="1" title="多选列表框">
        </td>
    </tr>
    <tr>
        <td>字段类型</td>
        <td>
            <select name="setup[fieldtype]" onchange="javascript:numbertype(this.value);">
                <option value="varchar" selected>字符 VARCHAR</option>
                <option value="tinyint">整数 TINYINT(3)</option>
                <option value="smallint">整数 SMALLINT(5)</option>
                <option value="mediumint">整数 MEDIUMINT(8)</option>
                <option value="int">整数 INT(10)</option>
            </select>
            <span id="numbertype" style="display:none;"  >
                <input type="checkbox" id="" name = "setup[numbertype]" value="1" checked />不包括负数
            </span>
        </td>
    </tr>
    <tr>
        <td>可见选项的数目</td>
        <td><input type="text" class="input-text layui-input" size="5" name="setup[size]" value="" /></td>
    </tr>
    <tr>
        <td>默认值</td>
        <td> <input type="text" class="input-text layui-input" size="5"  name="setup[default]" value="" /></td>
    </tr>
</table>

<?php break; case "editor": ?>
<table cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td width="140">编辑器类型：</td>
        <td><select name="setup[edittype]">
            <option value="layedit" selected>layedit</option>
            <option value="UEditor">UEditor</option>
        </select></td>
    </tr>
</table>
<?php break; case "datetime": break; case "groupid": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td width="120">选项类型</td>
        <td>
            <input type="radio" name="setup[inputtype]" value="checkbox" title="复选框">
            <input type="radio" name="setup[inputtype]" value="select" title="下拉列表框">
            <input type="radio" name="setup[inputtype]" value="radio" checked title="单选框">
        </td>
    </tr>
    <tr>
        <td>字段类型</td>
        <td>
            <select name="setup[fieldtype]"  onchange="javascript:numbertype(this.value);">
                <option value="varchar" selected>字符 VARCHAR</option>
                <option value="tinyint">整数 TINYINT(3)</option>
            </select>
            <span id="numbertype" style="display:none;"  >
                <input type="checkbox" id="" name = "setup[numbertype]" value="1" checked  title="不包括负数"/>
            </span>
        </td>
    </tr>
    <tr>
        <td>默认值</td>
        <td> <input type="text" class="input-text layui-input" size="5"  name="setup[default]" value="" /></td>
    </tr>
</table>

<?php break; case "typeid": ?>
<table class="typeTable" c cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td width="120">选项类型</td>
        <td>
            <input type="radio" name="setup[inputtype]" value="checkbox" title="复选框">
            <input type="radio" name="setup[inputtype]" value="select" title="下拉列表框">
            <input type="radio" name="setup[inputtype]" value="radio" checked title="单选框">
        </td>
    </tr>
    <tr>
        <td>字段类型</td>
        <td>
            <select name="setup[fieldtype]"  onchange="javascript:numbertype(this.value);">
                <option value="varchar" selected>字符 VARCHAR</option>
                <option value="tinyint" >整数 TINYINT(3)</option>
                <option value="smallint" >整数 SMALLINT(5)</option>
            </select>
            <span id="numbertype" style="display:none;"  >
                <input type="checkbox" id="" name = "setup[numbertype]" value="1" checked title="不包括负数"/>
            </span>
        </td>
    </tr>
    <tr>
        <td>顶级类别ID</td>
        <td> <input type="text" class="input-text layui-input" size="5"  name="setup[default]" value="" /></td>
    </tr>
</table>
<?php break; case "posid": break; case "radio": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td width="120">选项列表:<br>例: <font color="red">选项名称|值</font></td>
        <td><textarea  name="setup[options]" rows="5" cols="40"></textarea></td>
    </tr>
    <tr>
        <td>字段类型</td>
        <td>
            <select name="setup[fieldtype]" onchange="javascript:numbertype(this.value);">
                <option value="varchar" selected>字符 VARCHAR</option>
                <option value="tinyint">整数 TINYINT(3)</option>
                <option value="smallint">整数 SMALLINT(5)</option>
                <option value="mediumint">整数 MEDIUMINT(8)</option>
                <option value="int">整数 INT(10)</option>
            </select>
            <span id="numbertype" style="display:none;"  >
                <input type="checkbox" id="" name = "setup[numbertype]" value="1" checked title="不包括负数"/>
            </span>
        </td>
    </tr>
    <tr>
        <td>默认值</td>
        <td>
            <input type="text" class="input-text layui-input" size="5"  name="setup[default]" value="" />
        </td>
    </tr>
</table>

<?php break; case "checkbox": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td width="120">选项列表:<br>例: <font color="red">选项名称|值</font></td>
        <td>
            <textarea  name="setup[options]" rows="5" cols="40" class="layui-textarea"></textarea>
        </td>
    </tr>
    <tr>
        <td>字段类型</td>
        <td>
            <select name="setup[fieldtype]" onchange="javascript:numbertype(this.value);">
                <option value="varchar" selected>字符 VARCHAR</option>
                <option value="tinyint">整数 TINYINT(3)</option>
                <option value="smallint">整数 SMALLINT(5)</option>
                <option value="mediumint">整数 MEDIUMINT(8)</option>
                <option value="int">整数 INT(10)</option>
            </select>
            <span id="numbertype" style="display:none;"  >
                <input type="checkbox" id="" name = "setup[numbertype]" value="1" checked title="不包括负数"/>
            </span>
        </td>
    </tr>
    <tr>
        <td>默认值</td>
        <td>
            <input type="text" class="input-text layui-input" size="5"  name="setup[default]" value="" />
        </td>
    </tr>
</table>

<?php break; case "number": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td>是否包括负数：</td>
        <td>
            <input type="checkbox" id="" name = "setup[numbertype]" value="1" checked title="不包括负数"/>
        </td>
    </tr>
    <tr>
        <td>小数位数：</td>
        <td>
            <select name="setup[decimaldigits]">
                <option value="0"selected>0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>默认值</td>
        <td>
            <input type="text" name="setup[default]" value="" size="40" class="input-text layui-input">
        </td>
    </tr>
</table>
<?php break; case "image": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td>允许上传的图片类型</td>
        <td><input type="text" name="setup[upload_allowext]" value="jpg|jpeg|gif|png" class="input-text layui-input"></td>
    </tr>
</table>
<?php break; case "images": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
</table>
<?php break; case "file": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">
    <tr>
        <td>允许上传的文件类型</td>
        <td><input type="text" name="setup[upload_allowext]" value="zip|rar|doc|ppt" class="input-text layui-input"></td>
    </tr>
</table>
<?php break; case "files": ?>
<table class="typeTable" cellpadding="2" cellspacing="1" width="100%">

</table>
<?php break; default: endswitch; ?>

<script>
    function numbertype(fieldtype){
        if(fieldtype=='varchar'){
            $('#numbertype').hide();
        }else{
            $('#numbertype').show();
        }
    }
</script>