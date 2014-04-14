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

