<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$title}</title>
<link href="__PUBLIC__/css/base.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
</head>
<body>
<div id="header" the-to-lan="en_US">
        <div class="header_menu_bg">
            <div class="header_menu"> 
                <span class="logo png_ie6"><a href="{url('default/index/index')}">91频道</a></span>
                <div class="top_search">
                <div class="search_home"> <span class="search_icon"></span> <span class="search_up"></span> </div>
                <form action="">
                <input class="find_people" name="keyword" autocomplete="off" type="text" placeholder="搜索">
                <input class="find_people_button" value="" type="submit">
                </form>
                </div>
                <div style="display: block;" class="user_info">
                 {if !$memberoff}<!--判断会员中心app是否开启-->
            		 {if !empty($auth)}<!--判断会员是否登陆-->
                      <div class="user_poster">
                    <img title="{$uname}" src="{$small_photo}">
                    <span class="user_img_bg png_ie6"><a href=""></a></span>
                    </div>
                    <div class="user_name">
                        <span title="{$uname}" style="" class="zi">{$auth['uname']}</span><b class="arrow-ud png_ie6 "></b>
                       <ul class="user_item" style="display: none;">
                    <li><a href="{url('member/setting/avatar')}" target="_self">帐号设置</a></li>
                    <li><a href="{url('member/account/logout')}" target="_self">退出</a></li>
                    </ul>
                    </div>
                      {else}
                    <div class="user_info user_unlogin_info" style="display:block;">
                        <a class="popup-login" target="_self" href="">登录</a>
                        <span>|</span>
                        <a class="popup-login" target="_self" data-init="register" href="">注册</a>
                </div>
                 {/if}
           {/if}
                </div>
            </div>
                <div class="header_menu_two">
                    <div class="header_menus">
                        <ul class="left_menu">
                <li> <a  href="{url('member/index/index')}"  {$hover_index}>首页</a> </li>
                <li> <a href="{url('member/profile/index')}" {$hover_profile}>我的档案</a> </li>
                <li> <a href="{url('member/card/index')}" >人脉</a> </li>
                <li> <a href="#" class="popup-login">任务大厅</a>
                <div class="more_panel" style="overflow: hidden; height: 132px; display: none; margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 10px;">
                </div>
                </li>
                <li> <a  href="{url('company/index/index')}" {$hover_company}>公司</a> </li>
                <!--<li class="ce-new-li"> <a class="" href="http://www.tianji.com/ce">职业测评</a> <span class="ce-new png_ie6"></span></li>-->
                </ul>
             
             <ul class="right_menu" style="">
             <!-----通过ajax请求查看----->
          <li id="contacts_one" class="contacts contacts_loaded">
            <a href="#" class="icon_01" target="_self">
                <div class="clear"></div>
                <div class="span_promit png_ie6" data-num="4" style="display: block;">4</div>
            </a>
            
          </li>
          <li id="look_see1" class="message">
            <a href="#" class="icon_01" target="_self">
                <div class="clear"></div>
                <div class="span_promit png_ie6" style="display: block;">2</div>
            </a>
            
          </li>
          <li id="look_see2" class="tool">
            <a href="#" class="icon_01" target="_self">
                <div class="clear"></div>
                <div class="span_promit png_ie6" data-num="2" style="display: block;">2</div>
            </a>
            
          </li>
        </ul>
             
                        <div class="clear"></div>
                    </div>
               </div>
            </div>
        </div>
        
        