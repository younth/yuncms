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
            <a href="{url('member/message/index')}" class="icon_01" target="_self">
                <div class="clear"></div>
                {if $undo_count==0}
                {else}
                <div class="span_promit png_ie6" data-num="{$undo_count}" style="display: block;">{$undo_count}</div>
                {/if}
            </a>
            
<div class="messages_list" id="contacts_one_list" style="display: none;">
              <span class="list_c"></span>
              <span class="title_renmai">人脉邀请 <a href="#" class="all_kone" title="查看更多人脉邀请">更多</a></span>
              <span class="promit_no" style="display: none;">暂时没有收到人脉请求</span>
              <div class="loding_notice mg_r125" style="display: none;">正在加载.....</div>
              <ul class="contacts_main" id="new_header">
          
			</ul>
              
              
            </div>
                      </li>
          
          
<li class="message look_see1_loaded" id="look_see1">
            <a target="_self" class="icon_01" href="{url('member/message/index')}">
                <div class="clear"></div>
                {if $unread==0}
                {else}
                <div class="span_promit png_ie6" style="display: block;">{$unread}</div>
                {/if}
            </a>
            <div id="look_list1" style="display: none;" class="messages_list">
              <span class="list_c"></span>
              <span class="title_renmai">私信 <a class="wirte_info" href="#">写信</a> </span>
              <div style="display:none;" class="no_notice">还没有收到私信</div>
              <div class="loding_notice mg_r125" style="display: none;">正在加载.....</div>
              <div class="hd_scroll_box" style="display: block;">
                <ul id="new_header_message" class="contacts_main">
               
</ul>
                <div class="clear"></div>
              </div>
            </div>
          </li>
          
          <li id="look_see2" class="tool">
            <a href="#" class="icon_01" target="_self">
                <div class="clear"></div>
                <div class="span_promit png_ie6" data-num="2" style="display: block;">2</div>
            </a>

          </li>
        </ul>
             
                        <div class="clear"> </div>
                    </div>
               </div>
            </div>
        </div>
        
<script>
$(document).on("mouseover","#contacts_one",notice_friend);
var timer=null;//全局变量，定时器
function notice_friend(){
	var load_notice=$("#contacts_one .loding_notice");
	var contact_notice=$("#contacts_one .contacts_main");
	var show_li=$("#new_header");
	var no_notice=$("#contacts_one .promit_no");
		$("#contacts_one_list").slideDown(100);//显示通知区域
		$("#contacts_one").addClass("contacts_hover");
		//要使用ajax加载
		contact_notice.hide();	
		if($("#new_header li").length>0){
		contact_notice.show();
		}else{
			load_notice.show();//显示加载框
				//ajax请求数据，然后显示，隐藏加载通知
			//没有元素，则ajax请求,此处用setTimeout演示ajax的回调
			  $.ajax({
			  type: "GET",
			  url: "{url('member/message/friend_notice')}",
				 success: function (data) {
					 //没有通知，则显示没有收到人脉请求
					 load_notice.hide();
					 if(data==1){
						no_notice.show();//显示没有人脉请求,有个bug
						
					}else{
						contact_notice.empty();//清空之前的内容，防止浏览器缓存保留
						//显示加载的数据
						show_li.append(data);	
						contact_notice.show();//显示通知区域
					}
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});
			
		}
}

//鼠标离开私信的通知区域
$(document).on("mouseleave","#contacts_one",function(){
	timer=setTimeout(function(){
		$("#contacts_one_list").slideUp(100);
		},400)
	$("#contacts_one").removeClass("contacts_hover");
});

//鼠标在通知区域时候显示
$(document).on("mouseover","#contacts_one_list",function(){
		clearTimeout(timer);
	});


$("#new_header li").hover(function(){
	$(this).addClass("current").siblings().removeClass("current");
});

//点击删除通知
$(document).on("click",".bi_x1",function(){
	var delnode=$(this).parent();
	var card_id=delnode.data("id");
		  $.ajax({
		  type: "GET",
		  url: "{url('member/message/del_friend_notice')}",
		  data: {
			id: card_id,
		  },
			 success: function (data) {
				 //没有通知，则显示没有收到人脉请求
				delnode.remove();
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});
})


$(document).on("click",".agree_btn",function(){
	var delnode=$(this).parent();
	var card_id=delnode.data("id");
		  $.ajax({
		  type: "GET",
		  url: "{url('member/card/addfriend')}",
		  data: {
			id: card_id,
		  },
			 success: function (data) {
				 //没有通知，则显示没有收到人脉请求
				delnode.remove();
			 },
			  error: function (msg) {
					alert(msg);
			  }
		});
})


//接受邀请
	$(document).on("click",".agree_btn",function(){
		var node=$(this).parent();
		var  $send_id=node.data("userid");
	$.ajax({
	  url: "{url('card/accept')}",
	  data: {
		id: $send_id,
	  },
		 success: function (data) {
			//成功返回数据,不能用this
			 node.remove();
		 },
		  error: function (msg) {
				alert(msg);
		  }
	});
	
});


</script>

<script>
//私信通知
$(document).on("mouseover","#look_see1",function(){
	var load_notice=$("#look_see1 .loding_notice");
	var contact_notice=$("#look_see1 .contacts_main");
	var show_li=$("#new_header_message");
	var no_notice=$("#look_see1 .promit_no");
		$("#look_list1").slideDown(100);//显示通知区域
		$("#look_see1").addClass("contacts_hover");
		//要使用ajax加载
		contact_notice.hide();	
		if($("#new_header_message li").length>0){
		contact_notice.show();
		}else{
			load_notice.show();//显示加载框
				//ajax请求数据，然后显示，隐藏加载通知
			  $.ajax({
			  type: "GET",
			  url: "{url('member/message/msg_notice')}",
				 success: function (data) {
					 //没有通知，则显示没有收到人脉请求
					 //alert(data);
					 load_notice.hide();
					 if(data==1){
						no_notice.show();//显示没有人脉请求,有个bug
						
					}else{
						contact_notice.empty();//清空之前的内容，防止浏览器缓存保留
						//显示加载的数据
						show_li.append(data);	
						contact_notice.show();//显示通知区域
					}
				 },
				  error: function (msg) {
						alert(msg);
				  }
			});
			//没有元素，则ajax请求,此处用setTimeout演示ajax的回调
			contact_notice.show();//显示通知区域
		}
});

//鼠标离开私信的通知区域
$(document).on("mouseleave","#look_see1",function(){
	timer=setTimeout(function(){
		$("#look_list1").slideUp(100);	
	},400);
	$("#look_see1").removeClass("contacts_hover");
});

//鼠标在通知区域移动时候
$(document).on("mouseover","#look_list1",function(){
	clearTimeout(timer);
});



$("#new_header_message li").hover(function(){
	$(this).addClass("current").siblings().removeClass("current");
});


</script>