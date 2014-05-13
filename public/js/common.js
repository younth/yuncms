// JavaScript Document
$(function(){
	$("input[name=keyword]").bind({
		focus:function(){
			$(".find_people").addClass("find_bg");
			$(".find_people_button").addClass("find_btn_bg");
		},
		blur:function(){
		var $word=$("input[name=keyword]").val();
		 if($word.length>0){
		 $(".find_people_button").addClass("find_btn_bg");
		 }else {
			 $(".find_people").removeClass("find_bg");
			 $(".find_people_button").removeClass("find_btn_bg");
			 }
			}
		});
		
		//头像账号经过效果
		$(".user_name").hover(function(){
			$(this).addClass("user_bg font_hui");
			$(".user_item").css("display","block");
		},function(){
			$(this).removeClass("user_bg font_hui");
			$(".user_item").css("display","none");
			});
			
		$(".right_menu").hover(function(){
			//$(".right_menu li:first").css("display","block");
		},function(){
			//$(".right_menu li:first").css("display","none");
			});
	})


function copyToClipboard(maintext){
  if (window.clipboardData){
    window.clipboardData.setData("Text", maintext);
    }else if (window.netscape){
      try{
        netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
    }catch(e){
        layer.alert("该浏览器不支持一键复制！请手工复制文本框链接地址～");
    }

    var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
    if (!clip) return;
    var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
    if (!trans) return;
    trans.addDataFlavor('text/unicode');
    var str = new Object();
    var len = new Object();
    var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
    var copytext=maintext;
    str.data=copytext;
    trans.setTransferData("text/unicode",str,copytext.length*2);
    var clipid=Components.interfaces.nsIClipboard;
    if (!clip) return false;
    clip.setData(trans,null,clipid.kGlobalClipboard);
  }
  layer.alert('以下内容已经复制到剪贴板' + maintext, 1);
}

//返回顶部
$(function(){
  $(window).scroll(function () {
       
        if($(window).scrollTop()=="0") {
            $("#toTop").fadeOut("slow");
        }else {
            $("#toTop").fadeIn("slow");
        }
		//锁定导航
		if($(window).scrollTop()>20){
			$("#header").css({
				"position": "fixed",
				"top": "0px"
			});
			$(".header_menu_bg").css("height","40px");
			$(".header_menu").hide();
		}else{
			$("#header").css({
				"position": "relative",
				"top": "0px"
			});
			$(".header_menu_bg").css("height","100px");
			$(".header_menu").show();
			
		}
    });
    $("#toTop").on("click", function(){
        $("html,body").animate({scrollTop:0},300);return false;
    });
});

//首页的人脉通知
var timer=null;//全局变量，定时器
$(document).on("mouseover","#contacts_one",notice_friend);

function notice_friend(){
	var load_notice=$("#contacts_one .loding_notice");
	var contact_notice=$("#contacts_one .contacts_main");
	var show_li=$("#new_header");
	var no_notice=$("#contacts_one .promit_no");
	var url=$(this).data('url');
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
			  url: url,
				 success: function (data) {
					 //没有通知，则显示没有收到人脉请求
					 load_notice.hide();
					 if(data==1){
						no_notice.show();//显示没有人脉请求,有个bug
						return false;
						//如何阻止事件的冒泡
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
	var url=$(this).data('url');
		  $.ajax({
		  type: "GET",
		  url: url,
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
		var  $send_id=node.data("userid");//发送者id
		var url=$(this).data('url');
	$.ajax({
	  url: url,
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


//私信通知
$(document).on("mouseover","#look_see1",function(){
	var load_notice=$("#look_see1 .loding_notice");
	var contact_notice=$("#look_see1 .contacts_main");
	var show_li=$("#new_header_message");
	var no_notice=$("#look_see1 .promit_no");
	var url=$(this).data('url');
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
			  url: url,
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

//阻止事件冒泡的通用函数 
function stopBubble(e){
	// 如果传入了事件对象，那么就是非ie浏览器
	if (e && e.stopPropagation) {
		//因此它支持W3C的stopPropagation()方法
		e.stopPropagation();
	}else{
		//否则我们使用ie的方法来取消事件冒泡
		 window.event.cancelBubble = true;
	}
}

