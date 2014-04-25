<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$title}</title>
<link href="__PUBLIC__/css/base.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>
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
                <li> <a href="{url('member/card/index')}" {$hover_card}>人脉</a> </li>
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
                <div class="span_promit png_ie6" data-num="4" style="display: none;">4</div>
            </a>
            
<div class="messages_list" id="contacts_one_list" style="display: none;">
              <span class="list_c"></span>
              <span class="title_renmai">人脉邀请 <a href="http://www.tianji.com/contacts/invitation" class="all_kone" title="查看更多人脉邀请">更多</a></span>
              <span class="promit_no" style="display: none;">暂时没有收到人脉请求</span>
              <div class="loding_notice mg_r125" style="display: none;">正在加载.....</div>
              <ul class="contacts_main" id="new_header">
              
              


			</ul>
              
              
            </div>
                      </li>
          
          <li id="look_see1" class="message">
            <a href="{url('member/message/index')}" class="icon_01" target="_self">
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
        
<script>

$(document).on("mouseover",".icon_01",function(){
	var load_notice=$(".loding_notice");
	var contact_notice=$(".contacts_main");
		$("#contacts_one_list").slideDown(100);//显示通知区域
		$("#contacts_one").addClass("contacts_hover");
		//要使用ajax加载
		contact_notice.hide();	
		if($("#new_header li").length>0){
		//load_notice.hide();
		contact_notice.show();
		}else{
			load_notice.show();//显示加载框
				//ajax请求数据，然后显示，隐藏加载通知
			  $.ajax({
			  type: "GET",
			  url: "{url('member/card/addfriend')}",
			  data: {
				id: $uid,
			  },
				 success: function (data) {
					if(data==1){
						layer.msg('发送成功，等待对方验证',2,-1);
						node.replaceWith('<span class="sented">等待对方确认</span>');
					}
					if(data==2){
						layer.msg('发送成功，你们已经互为联系人了~',2,-1);
						node.replaceWith('<a href="javascript:void(0)" id="single_mail" class="send-msg"  uid="'+$uid+'" title="发私信"></a>');
					}
					
					
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});
			
			//没有元素，则ajax请求,此处用setTimeout演示ajax的回调
			setTimeout(function(){
					load_notice.hide();
					//显示加载的数据
					$("#new_header").append("<li>你好</li>");
					contact_notice.show();//显示通知区域
			},1000);
			
		}
});

//鼠标离开私信的通知区域
$(document).on("mouseleave","#contacts_one_list",function(){
	$("#contacts_one_list").slideUp(200);
	$("#contacts_one").removeClass("contacts_hover");
});

$("#new_header li").hover(function(){
	$(this).addClass("current").siblings().removeClass("current");
	})

</script>