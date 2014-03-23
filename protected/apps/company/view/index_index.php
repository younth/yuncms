<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/frame.css" />
<SCRIPT type=text/javascript src="__PUBLICAPP__/js/jquery.layout.js"></SCRIPT>
<SCRIPT type=text/javascript src="__PUBLIC__/artDialog/jquery.artDialog.js"></SCRIPT>
<SCRIPT type=text/javascript src="__PUBLIC__/artDialog/plugins/iframeTools.js"></SCRIPT>
<SCRIPT type="text/javascript"> 
var myLayout;
$(document).ready(function(){
myLayout=$("body").layout({west__minSize:40,spacing_open:4,spacing_closed:4,east__initClosed:true,north__spacing_open:0,south__spacing_open:0,togglerLength_open:30,togglerLength_closed:60});
$("#refreash").click(function(){ 
		  window.main.location.reload();
});
});
</SCRIPT>
<BODY style="MARGIN: 0px" scroll=no>
<DIV class=ui-layout-north>
<DIV class=header>
            <DIV class=logo>会员中心</DIV>
            <DIV class="info">{if !empty($auth)}  <font color="#FF9900">{$auth['uname']}</font>欢迎您回来！您上次登录的IP是{$auth['lastip']}  {/if}</DIV>
            <DIV class=right_menu>
                <SPAN><A class=cc id="refreash" href="javascript:void();">刷新内页</A></SPAN>
                <SPAN><A class=bb href="{url('default/index/index')}" target="_blank">网站主页</A></SPAN>
                <SPAN><A class=aa href="{url('infor/password')}" target="main">修改密码</A></SPAN> 
                <SPAN><A class=dd href="{url('index/logout',array('url'=>url('default/index/index')))}" >注销登录</A></SPAN> 
            </DIV>
          </DIV>
</DIV>
 
<DIV class=ui-layout-west>
   <DIV id=menu>
         <DIV class="menubg_1 cursor">账户管理</DIV>
         <UL class='none'>
                <LI><A href="{url('infor/password')}" target="main">修改密码</A></LI>
		  		<LI><A href="{url('infor/index')}" target="main">资料完善</A></LI>
				<LI><A href="{url('infor/rmb')}" target="main">我的账户</A></LI>
		 </UL>
         <DIV class="menubg_1 cursor">在线购物</DIV>
         <UL class='none'>
		  		<LI><A href="{url('shopcar/index')}" target="main">购物车</A></LI>
				<LI><A href="{url('order/index')}" target="main">订单管理</A></LI>
		</UL>
   </DIV>
</DIV>
<DIV class=ui-layout-center>
<IFRAME style="OVERFLOW: visible" id="main" height="100%" src="{$act}" frameBorder=0 width="100%" name="main" scrolling=yes></IFRAME>
</DIV>
<SCRIPT language=javascript>
$(function(){
	$("#menu").find('DIV').first().attr('class','menubg_2');
	$("#menu").find('UL').first().show();
	$("#menu DIV").click(function(){
		$("#menu DIV").attr('class','menubg_1');
		$("#menu UL").hide();
		$(this).attr('class','menubg_2');
		$(this).next().show();
	});
});
</SCRIPT>