<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\wechat\menu.html";i:1512619523;s:75:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\common\head.html";i:1512630547;s:75:"E:\phpStudy\PHPTutorial\WWW\thinkphp\cltphp/app/admin\view\common\foot.html";i:1503623995;}*/ ?>
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
<link rel="stylesheet" href="__ADMIN__/wxMenu/wx_base.css">
<link rel="stylesheet" href="__ADMIN__/wxMenu/wx_index.css">
<link rel="stylesheet" href="__ADMIN__/wxMenu/wx_tooltip.css">
<link rel="stylesheet" href="__ADMIN__/wxMenu/wx_lib.css"/>
<link rel="stylesheet" href="__ADMIN__/wxMenu/wx_richvideo.css"/>
<link rel="stylesheet" type="text/css" href="__ADMIN__/defau.css">
<style>
    .draggable-element {  display: inline-block;  text-align: center;  color: rgb(51, 51, 51);  cursor: move;  }
    body {  background: #fff;}
    .layui-table-cell{height: auto;}
    .layui-table-cell ul li a{color: #1C8FEF;display: block;border: 1px solid #ececec;padding: 3px 8px;}
    .layui-table-cell ul li a:hover{color: #005580}
    .layui-table-view{margin: 0;}
    .layui-table{margin: 0;}
</style>
<script>
    var UMTW = "<?php echo url('updatemenutoweixin'); ?>"
    var UWMET = "<?php echo url('updateweixinmenueventtype'); ?>"
    var AWM = "<?php echo url('addweixinmenu'); ?>"
    var UWMN = "<?php echo url('updateweixinmenuname'); ?>"
    var UWMU = "<?php echo url('updateweixinmenuurl'); ?>"
    var DWM = "<?php echo url('deleteweixinmenu'); ?>"
    var UWMM = "<?php echo url('updateweixinmenumessage'); ?>"
    var GWMD = "<?php echo url('getweixinmediadetail'); ?>"
    var UWMS = "<?php echo url('updateweixinmenuSort'); ?>"
    var PUBLIC = "__PUBLIC__"
</script>
<script src="__STATIC__/common/js/jquery-1.8.1.min.js"></script>
<script src="__STATIC__/common/js/drag-arrange.js"></script>
<script src="__ADMIN__/wx_menu/wx_menu.js"></script>
<script type="text/javascript" src="__STATIC__/plugins/layui/layui.js"></script>


<div class="admin-main layui-anim layui-anim-upbit">
    <fieldset class="layui-elem-field layui-field-title">
        <legend>菜单管理</legend>
    </fieldset>
    <div class="RIGHT">
        <div class="ns-main">
            <?php if($menu_list_count == 0): ?>
            <!-- 你尚未添加任何菜单 -->
            <blockquote class="layui-elem-quote js_startMenuBox">
                你尚未添加任何菜单
                <a class="layui-btn js_openMenu"  href="javascript:void(0);" target="_blank">添加菜单</a>
            </blockquote>
            <?php else: endif; ?>
            <div class="js_editBox" style="<?php if($menu_list_count == 0): ?>display:none;<?php endif; ?>">
                <div class="menu_preview_area">
                    <div class="mobile_menu_preview">
                        <div class="mobile_hd tc"><?php echo $wx_name; ?></div>
                        <div class="mobile_bd">
                            <!-- 菜单 -->
                            <ul class="pre_menu_list grid_line" id="menuList">
                                <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $k=>$menu): ?>
                                <!-- 加载菜单 -->
                                <li class="pre_menu_item size1of<?php echo $class_index+1; if(($k+1)==$menu_list_count): ?> current<?php endif; ?>" data-menu-index="<?php echo $k+1; ?>">
                                    <!-- 一级菜单 -->
                                    <a href="javascript:void(0);" ondragstart="return false" class="pre_menu_link jsMenu"
                                       data-menuid="<?php echo $menu['menu_id']; ?>" data-pid="0" data-menu-eventurl="<?php echo $menu['menu_event_url']; ?>"
                                       data-menu-type="<?php echo $menu['menu_event_type']; ?>" data-detault-menu-type="<?php echo $menu['menu_event_type']; ?>"
                                       data-mediaid="<?php echo $menu['media_id']; ?>" data-sort="<?php echo $menu['sort']; ?>">
                                        <?php if($menu['child_count'] > 0): ?>
                                        <!-- 有二级菜单，显示小图标 -->
                                        <i class="icon_menu_dot js_icon_menu_dot dn"></i>
                                        <?php endif; ?>
                                        <span><?php echo $menu['menu_name']; ?></span>
                                    </a>
                                    <!-- 一级菜单 -->
                                    <!-- 二级菜单 -->
                                    <div class="sub_pre_menu_box" data-submenulist="<?php echo $k+1; ?>" style="<?php if(($k+1)!=$menu_list_count): ?>display: none;<?php endif; ?>" >
                                        <ul class="sub_pre_menu_list">
                                            <?php if(is_array($menu['child']) || $menu['child'] instanceof \think\Collection || $menu['child'] instanceof \think\Paginator): if( count($menu['child'])==0 ) : echo "" ;else: foreach($menu['child'] as $key=>$sub_menu): ?>
                                            <li class="jsSubMenuInner">
                                                <a href="javascript:void(0);" ondragstart="return false" data-pid="<?php echo $sub_menu['pid']; ?>"
                                                   data-menuid="<?php echo $sub_menu['menu_id']; ?>" data-menu-eventurl="<?php echo $sub_menu['menu_event_url']; ?>"
                                                   data-menu-type="<?php echo $sub_menu['menu_event_type']; ?>"
                                                   data-detault-menu-type="<?php echo $sub_menu['menu_event_type']; ?>"
                                                   data-mediaid="<?php echo $sub_menu['media_id']; ?>" data-sort="<?php echo $sub_menu['sort']; ?>">
                                                    <span class="sub_pre_menu_inner"><?php echo $sub_menu['menu_name']; ?></span>
                                                </a>
                                            </li>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                            <!-- 限制二级菜单数量的添加 -->
                                            <li class="jsSubMenu" data-pid="<?php echo $menu['menu_id']; ?>" data-subindex="<?php echo $k+1; ?>" style="<?php if($menu['child_count'] ==$MAX_SUB_MENU_LENGTH): ?>display:none;<?php endif; ?>" >
                                                <a href="javascript:void(0);" title="最多添加<?php echo $MAX_SUB_MENU_LENGTH; ?>个子菜单">
                                                    <span class="sub_pre_menu_inner">
                                                        <i class="icon14_menu_add" style="background-position: 0 0;"></i>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <i class="arrow arrow_out"></i> <i class="arrow arrow_in"></i><!-- 箭头 -->
                                    </div>
                                    <!-- 二级菜单 -->
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <!-- 限制一级菜单数量的添加 -->
                                <li class="js-addMenuBtn pre_menu_item size1of<?php echo $class_index+1; ?>" style="<?php if($menu_list_count >= $MAX_MENU_LENGTH): ?>display:none;<?php endif; ?>"  data-class-index="<?php echo $class_index+1; ?>">
                                    <a href="javascript:void(0);" class="pre_menu_link " title="最多添加<?php echo $MAX_MENU_LENGTH; ?>个一级菜单">
                                        <i class="icon14_menu_add"></i>
                                        <?php if($menu_list_count==0): ?>
                                        <span>添加菜单</span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            </ul>
                        <!-- 菜单 -->
                        </div>
                    </div>
                    <!-- 菜单排序，后期实现拖拽 -->
                    <div class="sort_btn_wrp" style="<?php if($menu_list_count == 0): ?>display:none;<?php endif; ?>" >
                        <a id="orderBt" class="<?php if($menu_list_count <2): ?> dn <?php endif; ?> layui-btn layui-btn-primary" href="javascript:void(0);">菜单排序</a>
                        <span id="orderDis" class="<?php if($menu_list_count >1): ?> dn <?php endif; ?> layui-btn layui-btn-primary layui-btn-disabled">菜单排序</span>
                        <a id="finishBt" href="javascript:void(0);" class="dn layui-btn">完成</a>
                    </div>
                </div>
                <div class="menu_form_area">
                    <!-- 点击左侧菜单进行编辑操作 -->
                    <div id="js_none" class="menu_initial_tips tips_global" style="display: none;">请通过拖拽左边的菜单进行排序</div>
                    <div id="js_rightBox" class="portable_editor to_left">
                        <div class="editor_inner">
                            <div class="global_mod float_layout menu_form_hd js_second_title_bar">
                                <h4 class="global_info"><?php echo $default_menu_info['menu_name']; ?></h4>
                                <div class="global_extra">
                                    <a href="javascript:void(0);" id="jsDelBt" data-menuid="<?php echo $default_menu_info['menu_id']; ?>" data-menuname="<?php echo $default_menu_info['menu_name']; ?>">删除菜单</a>
                                </div>
                            </div>
                            <div class="menu_form_bd" id="view">
                                <div id="js_innerNone" class="msg_sender_tips tips_global" style="<?php if($default_menu_info['child_count']==0): ?>display: none;<?php endif; ?>" >
                                    已添加子菜单，仅可设置菜单名称。
                                </div>
                                <div class="frm_control_group js_setNameBox">
                                    <label for="menuname" class="frm_label"><strong class="title js_menuTitle">菜单名称</strong></label>
                                    <div class="frm_controls">
                                        <span class="frm_input_box with_counter counter_in append">
                                            <input type="text" id="menuname" data-switch="menuname" class="frm_input" style="box-shadow: none; padding: 0;" value="<?php echo $default_menu_info['menu_name']; ?>">
                                        </span>
                                        <p class="frm_msg fail js_titleEorTips dn" style="display: none;">字节超过上限</p>
                                        <p class="frm_tips js_titleNolTips">字数不超过4个汉字或8个字母</p>
                                    </div>
                                </div>
                                <div class="frm_control_group js_setGraphic" style="<?php if($default_menu_info['child_count']>0): ?>display:none;<?php endif; ?>" >
                                    <label for="" class="frm_label"> <strong class="title js_menuContent">菜单内容</strong></label>
                                    <div class="frm_controls frm_vertical_pt">
                                        <label class="frm_radio_label js_radio_sendMsg <?php if($default_menu_info['menu_event_type'] == 2|| $default_menu_info['menu_event_type'] == 3): ?>selected<?php endif; ?>">
                                            <i class="icon_radio"></i> <span class="lbl_content">发送消息</span>
                                        </label>
                                        <label class="frm_radio_label js_radio_url  <?php if($default_menu_info['menu_event_type'] == 1): ?>selected<?php endif; ?>">
                                            <i class="icon_radio"></i> <span class="lbl_content">跳转网页</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="menu_content_container js_setGraphic" style="<?php if($default_menu_info['child_count']>0): ?>display:none;<?php endif; ?>">
                                    <!-- 发送消息 -->
                                    <div class="menu_content send jsMain" id="edit"  style="<?php if($default_menu_info['menu_event_type'] == 2|| $default_menu_info['menu_event_type'] == 3): ?>display: block;<?php else: ?>display:none;<?php endif; ?>">
                                        <div class="msg_sender" id="editDiv">
                                            <div class="msg_tab">
                                                <div class="tab_navs_panel">
                                                    <div class="tab_navs_wrp">
                                                        <ul class="tab_navs js_tab_navs">
                                                            <li class="tab_nav tab_appmsg width4 selected" data-type="10" data-tab=".js_appmsgArea" data-tooltip="图文消息">
                                                                <a href="javascript:void(0);">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">图文消息</span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="tab_panel">
                                                    <div class="tab_content">
                                                        <div class="js_appmsgArea inner ">
                                                            <div class="tab_cont_cover jsMsgSendTab" style="<?php if($default_menu_info['media_id'] != 0): ?>display:none;<?php endif; ?>" >
                                                                <div class="media_cover">
                                                                    <span class="create_access">
                                                                        <a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;">
                                                                            <i class="icon36_common add_gray"></i> <strong>从素材库中选择</strong>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                                <div class="media_cover">
                                                                    <span class="create_access">
                                                                        <a class="add_gray_wrp" href="<?php echo url('addMedia'); ?>">
                                                                            <i class="icon36_common add_gray"></i> <strong>新建图文消息</strong>
                                                                        </a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div id="show_media" style="<?php if($default_menu_info['media_id'] == 0): ?>display:none;<?php endif; ?>" >
                                                                <div class="appmsg multi has_first_cover">
                                                                    <div class="appmsg_content">
                                                                        <div class="appmsg_info">
                                                                            <em class="appmsg_date">
                                                                                <?php echo $default_menu_info['media_list']['create_time']; ?>
                                                                            </em>
                                                                        </div>
                                                                        <div class="cover_appmsg_item">
                                                                            <h4 class="appmsg_title js-media-title">
                                                                                <a href="" target="_blank">
                                                                                    <?php echo $default_menu_info['media_list']['title']; ?>
                                                                                </a>
                                                                            </h4>
                                                                            <!-- 封面 -->
                                                                            <div class="appmsg_thumb_wrp" style="<?php if($default_menu_info['media_list']['item_list_count'] >0 and $default_menu_info[media_list][item_list][0][cover]): ?>background-image:url('__PUBLIC__<?php echo $default_menu_info[media_list][item_list][0][cover]; ?>')<?php endif; ?>" ></div>
                                                                        </div>
                                                                        <?php if($default_menu_info['media_list']['item_list_count'] >1): if(is_array($default_menu_info['media_list']['item_list']) || $default_menu_info['media_list']['item_list'] instanceof \think\Collection || $default_menu_info['media_list']['item_list'] instanceof \think\Paginator): if( count($default_menu_info['media_list']['item_list'])==0 ) : echo "" ;else: foreach($default_menu_info['media_list']['item_list'] as $i=>$media): if($i != 0): ?>
                                                                        <div class="appmsg_item has_cover">
                                                                            <div class="appmsg_thumb_wrp" style="background-image:url('__PUBLIC__<?php echo $media['cover']; ?>');"></div>
                                                                            <h4 class="appmsg_title js_title">
                                                                                <a href="javascript:;" target="_blank"><?php echo $media['title']; ?></a>
                                                                            </h4>
                                                                        </div>
                                                                        <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                                                                    </div>
                                                                </div>
                                                                <a href="javascript:;" class="jsmsgSenderDelBt link_dele" data-mediaid="<?php echo $default_menu_info['media_id']; ?>">删除</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="profile_link_msg_global menu_send mini_tips warn dn js_warn">请勿添加其他公众号的主页链接</p>
                                    </div>
                                    <!-- 发送消息 -->
                                    <!-- 跳转网页 -->
                                    <div class="menu_content url jsMain" id="url" style="<?php if($default_menu_info['menu_event_type'] == 1): ?> display: block;<?php else: ?>display:none;<?php endif; ?>">
                                        <p class="menu_content_tips tips_global">订阅者点击该子菜单会跳到以下链接</p>
                                        <div class="frm_control_group">
                                            <label for="urltext" class="frm_label"><strong class="title">页面地址</strong></label>
                                            <div class="frm_controls">
                                                <span class="frm_input_box">
                                                    <input type="text" class="frm_input" id="urltext" data-switch="url" value="<?php echo $default_menu_info['menu_event_url']; ?>" name="urlText" style="border: 0; box-shadow: none; padding: 0;">
                                                </span>
                                                <p class="profile_link_msg_global menu_url mini_tips warn dn js_warn">请勿添加其他公众号的主页链接</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="js_errTips" style="display: none;" class="msg_sender_msg mini_tips warn"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 左箭头 -->
                        <span class="editor_arrow_wrp">
                            <i class="editor_arrow editor_arrow_out"></i>
                            <i class="editor_arrow editor_arrow_in"></i>
                        </span>
                        <!-- 左箭头 -->
                    </div>
                    <!-- 点击左侧菜单进行编辑操作 -->
                </div>
            </div>
            <!-- 菜单编辑 -->
            <div class="tool_bar tc js_editBtn" style="<?php if($menu_list_count == 0): ?>visibility: hidden;<?php endif; ?>" >
                <span id="pubBt" class="btn btn_input btn_primary" style="display: inline-block;"><button>保存并发布</button></span>
                <a href="javascript:void(0);" class="btn btn_default" id="viewBt" style="display: inline-block;">预览</a>
            </div>
            <!-- 删除菜单弹出框 -->
            <div class="dialog_wrp  ui-draggable" style="width: 720px; margin-left: -360px; margin-top: -186px; display: none;"
                 id="wxDelDialog">
                <div class="dialog">
                    <div class="dialog_hd">
                        <h3>温馨提示</h3>
                        <a href="javascript:;" class="pop_closed">关闭</a>
                    </div>
                    <div class="dialog_bd">
                        <div class="page_msg large simple default ">
                            <div class="inner group">
                                <span class="msg_icon_wrapper"><i class="icon_msg warn "></i></span>
                                <div class="msg_content ">
                                    <h4>删除确认</h4>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dialog_ft">
                        <a href="javascript:;" class="btn btn_primary js_btn">确定</a>
                        <a href="javascript:;" class="btn btn_default js_btn">取消</a>
                    </div>
                </div>
            </div>
            <!-- 删除菜单弹出框 -->

            <!-- 手机预览 -->
            <div class="mobile_preview" id="mobileDiv" style="display: none;">
                <div class="mobile_preview_hd">
                    <strong class="nickname"><?php echo $wx_name; ?></strong>
                </div>
                <div class="mobile_preview_bd">
                    <ul id="viewShow" class="show_list"></ul>
                </div>
                <div class="mobile_preview_ft">
                    <ul class="pre_menu_list grid_line" id="viewList">
                        <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $k=>$menu): ?>
                        <li class="pre_menu_item grid_item size1of<?php echo $menu_list_count; ?>" data-mobile-menu-index="<?php echo $k+1; ?>">
                            <a href="javascript:void(0);" class="jsView pre_menu_link" title="<?php echo $menu['menu_name']; ?>" data-menuid="<?php echo $menu['menu_id']; ?>">
                                <?php if($menu['child_count'] > 0): ?>
                                <i class="icon_menu_dot"></i>
                                <?php endif; ?>
                                <span><?php echo $menu['menu_name']; ?></span>
                            </a>
                            <div class="sub_pre_menu_box jsSubViewDiv" data-subIndex="<?php echo $k+1; ?>" style="display: none">
                                <ul class="sub_pre_menu_list">
                                    <?php if(is_array($menu['child']) || $menu['child'] instanceof \think\Collection || $menu['child'] instanceof \think\Paginator): if( count($menu['child'])==0 ) : echo "" ;else: foreach($menu['child'] as $key=>$sub_menu): ?>
                                    <li>
                                        <a href="javascript:void(0);" data-pid="<?php echo $sub_menu['pid']; ?>" data-menuid="<?php echo $sub_menu['menu_id']; ?>" class="jsSubView" title="<?php echo $sub_menu['menu_name']; ?>"><?php echo $sub_menu['menu_name']; ?></a>
                                    </li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                                <i class="arrow arrow_out"></i><i class="arrow arrow_in"></i>
                            </div>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <a href="javascript:void(0);" class="mobile_preview_closed btn btn_default" id="viewClose">退出预览</a>
            </div>

            <!-- 遮罩层 -->
            <div class="mask" style="display: none;" id="maskLayer"></div>

            <!--选择文章-->
            <div class="dialog_wrp media align_edge ui-draggable" style="display:none;width: 960px; margin-left: -480px; margin-top: -313.5px;" id="dialog_media">
                <div class="dialog">
                    <div class="dialog_hd">
                        <h3>选择素材</h3>
                        <!--#0001#-->
                        <a href="javascript:;" onclick="closeMaterial()" class="icon16_opr closed pop_closed">关闭</a>
                        <!--%0001%-->
                    </div>
                    <div class="dialog_bd">
                        <div class="dialog_media_container appmsg_media_dialog">
                            <div class="sub_title_bar in_dialog">
                                <div class="search_bar js-btn-media">
                                    <a class="layui-btn layui-btn-primary layui-btn-small" value="1" href="javascript:;" onclick="checkBtn(this)"> 文本 </a>
                                    <a class="layui-btn layui-btn-normal layui-btn-small" value="2" href="javascript:;" onclick="checkBtn(this)"> 单图文 </a>
                                    <a class="layui-btn layui-btn-primary layui-btn-small" href="javascript:;" value="3" onclick="checkBtn(this)"> 多图文 </a>
                                </div>
                                <div class="appmsg_create tr">
                                    <a class="layui-btn layui-btn-small" href="<?php echo url('addmedia',['url'=>'menu']); ?>"> 新建图文消息 </a>
                                </div>
                            </div>
                            <div class="dialog_media_inner" style="overflow:auto;">
                                <div class="table_wrp user_list">
                                    <table class="layui-table" id="list" lay-filter="list"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dialog_ft_page">
                    </div>
                </div>
            </div>
            <div class="mask mask_metar" style="display: none;"></div>
            <!-- 操作反馈弹出框 erro 失败-->
            <div class="JS_TIPS page_tips success" id="wxTips" style="display:none;">
                <div class="inner"></div>
            </div>

            <input type="hidden" id="hidden_default_sort"/>
            <input type="hidden" id="hidden_default_sub_sort"/>
        </div>
        <!-- 公共的操作提示弹出框 common-success：成功，common-warning：警告，common-error：错误，-->
        <div class="common-tip-message js-common-tip">
            <div class="inner"></div>
        </div>
    </div>
</div>
<script type="text/html" id="title">
    <ul>
        {{# for(var l=0; l<d.item_list.length; l++){ }}
        <li><a href="#">{{d.item_list[l]['title']}}</a></li>
        {{# } }}
    </ul>
</script>
<script type="text/html" id="action">
    <a href="javascript:;" class="layui-btn layui-btn-mini remark js_msgSenderRemark" onclick="selectedMaterial({{d.media_id}})">选取</a>
</script>
<script>
    function checkBtn(event){
        $(".js-btn-media").find('.layui-btn').removeClass('layui-btn-normal').addClass('layui-btn-primary');
        $(event).removeClass('layui-btn-primary').addClass('layui-btn-normal');
        LoadingInfo();
    }
    LoadingInfo();
    function LoadingInfo() {
        layui.use('table', function () {
            var table = layui.table, $ = layui.jquery;
            var type = $(".js-btn-media .layui-btn-normal").attr('value');
            table.render({
                id: 'msg',
                elem: '#list',
                url: '<?php echo url("onloadmaterial"); ?>',
                method: 'post',
                page: true,
                where:{type:type},
                cols: [[
                    {field: 'title', title: '<?php echo lang("title"); ?>', width: 250, templet: '#title'},
                    {field: 'create_time', title: '创建时间', width: 250},
                    {width: 160, align: 'center', toolbar: '#action'}
                ]],
                limit: 10
            });
        });
    }
    /**
     * 选择 图文素材
     */
    function selectedMaterial(media_id){
        getMaterial(media_id);
        closeMaterial();
    }
    /**
     *  取消  关闭
     */
    function closeMaterial(){
        $("#dialog_media").fadeOut(300);
        $(".mask_metar").fadeOut();
    }
</script>

</body>
</html>