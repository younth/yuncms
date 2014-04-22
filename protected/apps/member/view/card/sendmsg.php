<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>
<link href="__PUBLIC__/member/css/my_file.css" media="screen" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/member/css/sendmsg.css" media="screen" rel="stylesheet" type="text/css" />
<title></title>
</head>
<body>
<div class="dj-write-box">
    <div class="i-item user-item clearfix"><span class="title">收信人:</span><div class="item-input"><div class="user-item-content ms-wrap"><div class="ms-data-wrap"><div class="ms-data ms-disabled"><a rel="26720451" href="javascript:void(0);" class="ms-selected-item"><span class="text">{$re_name}</span></a></div></div><input type="hidden" value="26720451" name="uid" class="ms-hidden"></div></div></div>
    <div class="i-item content-item clearfix"><span class="title">内容:</span><div class="item-input"><textarea class="input-txt e-content" name="content" placeholder="最多只能输入1000个字..."></textarea></div></div><div class="i-item action-item"><div class="i_copylink_btn">
    <a href="javascript:;">发送</a></div></div>

</div>
<script>
$(function(){
	$("textarea").focus();
	//ajax发送私信
	$(document).on('click','.i_copylink_btn a',function(){
		var content=$(".e-content").val();
		//发送私信
			  $.ajax({
			  type: "POST",
			  url: "{url('member/card/sendmsg')}",
			  data: {
				 id:{$id},
				content: content,
			  },
				 success: function (data) {
					 //关闭弹出
					 //alert(data);
					var i = parent.layer.getFrameIndex(window.name);
					layer.msg('发送私信成功~',1,-1);	
					//延迟执行
					setTimeout(function(){
							parent.layer.close(i);
						}, 500);					
				
				},
				  error: function (msg) {
						alert(msg);
				  }
			});
		
	});
})
</script>
</body>
</html>